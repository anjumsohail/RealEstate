<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UpdateGeometry extends Command
{
    protected $signature = 'geometry:update {--table=} {--id=} {--geojson}';
    protected $description = 'Fetch OSM geometry and update database geometry column (supports cities, towns, sectors, blocks)';

    public function handle()
    {
        $table = $this->option('table');
        $id    = $this->option('id');
        $saveGeoJson = $this->option('geojson');

        if (!$table || !in_array($table, ['cities', 'towns', 'sectors', 'blocks'])) {
            $this->error("Please provide --table=cities|towns|sectors|blocks");
            return;
        }

        $this->info("=== Processing table: {$table}" . ($id ? " id={$id}" : " (all)") . " ===");

        $query = DB::table($table)
            ->select('id', 'osm_relation_id')
            ->when($id, fn($q) => $q->where('id', $id))
            ->whereNotNull('osm_relation_id')
            ->where('osm_relation_id', '>', 0)
            ->whereRaw("ST_GeometryType(geometry) = 'POINT'")
            ->get();

        foreach ($query as $row) {
            try {
                $osmId = $row->osm_relation_id;

                // Detect type (relation or way)
                $type = $this->detectOSMType($osmId);
                if (!$type) {
                    $this->warn("⚠️ Could not detect OSM type for {$table} id={$row->id}");
                    continue;
                }

                $this->info("=== Processing {$table} id={$row->id}, OSM {$type}={$osmId} ===");

                // Fetch raw Overpass JSON
                $jsonData = $this->fetchOverpass($osmId, $type);
                if (!$jsonData) {
                    $this->error("❌ Failed fetching OSM {$type}={$osmId}");
                    continue;
                }

                // Save raw JSON for debug
                $dir = "osm_raw/{$table}";
                Storage::makeDirectory($dir);
                Storage::put("{$dir}/{$row->id}.json", json_encode($jsonData, JSON_PRETTY_PRINT));

                // Convert to GeoJSON using osmtogeojson
                $geojson = $this->convertToGeoJSON($jsonData);
                if (!$geojson) {
                    $this->error("❌ osmtogeojson conversion failed for {$table} id={$row->id}");
                    continue;
                }

                if ($saveGeoJson) {
                    $geoDir = "geojson/{$table}";
                    Storage::makeDirectory($geoDir);
                    Storage::put("{$geoDir}/{$row->id}.geojson", $geojson);
                    $this->info("📂 GeoJSON saved for {$table} id={$row->id}");
                }

                // Convert GeoJSON → WKT
                $wkt = $this->geojsonToWKT($geojson);
                if (!$wkt) {
                    $this->warn("⚠️ Could not generate WKT for {$table} id={$row->id}");
                    continue;
                }

                // Update DB
                DB::statement("UPDATE {$table} SET geometry = ST_GeomFromText(?, 4326) WHERE id = ?", [$wkt, $row->id]);
                $this->info("✅ Geometry updated for {$table} id={$row->id}");

            } catch (\Throwable $e) {
                $this->error("💥 Exception at {$table} id={$row->id}: " . $e->getMessage());
            }
        }

        $this->info("=== Done. ===");
    }

    protected function detectOSMType($osmId)
    {
        $url = "https://nominatim.openstreetmap.org/lookup?format=json&osm_ids=R{$osmId},W{$osmId}";
        $resp = Http::withHeaders(['User-Agent' => 'MyLaravelApp/1.0'])->get($url);
        if (!$resp->ok()) return null;

        $data = $resp->json();
        if (empty($data)) return null;

        return $data[0]['osm_type'] ?? null; // "relation" or "way"
    }

        protected function fetchOverpass($osmId, $type)
            {
                // Use body geom to avoid 400 errors
                $query = "[out:json][timeout:60];{$type}({$osmId});(._;>;);out body geom;";
                $url   = "https://overpass-api.de/api/interpreter";

                $this->info("🔎 Overpass Debug:");
                $this->line("   Query: " . $query);

                $resp = Http::timeout(60)->asForm()->post($url, ['data' => $query]);

                if (!$resp->ok()) {
                    $this->error("   ❌ Overpass HTTP Status: {$resp->status()}");
                    $this->line("   Raw Body (first 300 chars): " . substr($resp->body(), 0, 300));
                    return null;
                }

                $json = json_decode($resp->body(), true);

                if (!$json || !isset($json['elements'])) {
                    $this->error("   ❌ Invalid Overpass JSON response");
                    return null;
                }

                return $json;
            }


    protected function convertToGeoJSON($jsonData)
    {
        $inputFile = storage_path('app/osm_input.json');
        $outputFile = storage_path('app/osm_output.geojson');

        file_put_contents($inputFile, json_encode($jsonData));

        $cmd = "osmtogeojson " . escapeshellarg($inputFile) . " > " . escapeshellarg($outputFile) . " 2>&1";
        exec($cmd, $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error("   ❌ osmtogeojson failed: " . implode("\n", $output));
            return null;
        }

        return file_get_contents($outputFile);
    }

    protected function geojsonToWKT($geojson)
    {
        $data = json_decode($geojson, true);
        if (!$data || !isset($data['features'])) return null;

        $wkts = [];

        foreach ($data['features'] as $feature) {
            $geom = $feature['geometry'] ?? null;
            if (!$geom) continue;

            $type = strtoupper($geom['type']);
            $coords = $geom['coordinates'];

            switch ($type) {
                case 'POLYGON':
                    $wkts[] = $this->polygonToWKT($coords);
                    break;
                case 'MULTIPOLYGON':
                    $wkts[] = $this->multiPolygonToWKT($coords);
                    break;
            }
        }

        if (empty($wkts)) return null;
        return count($wkts) === 1 ? $wkts[0] : "MULTIPOLYGON(" . implode(",", array_map(fn($w) => trim(str_replace("POLYGON", "", $w)), $wkts)) . ")";
    }

    private function polygonToWKT($coords)
    {
        $rings = [];
        foreach ($coords as $ring) {
            $points = array_map(fn($p) => $p[0] . " " . $p[1], $ring);
            if ($points[0] !== end($points)) $points[] = $points[0];
            $rings[] = "(" . implode(",", $points) . ")";
        }
        return "POLYGON(" . implode(",", $rings) . ")";
    }

    private function multiPolygonToWKT($coords)
    {
        $polygons = [];
        foreach ($coords as $poly) {
            $rings = [];
            foreach ($poly as $ring) {
                $points = array_map(fn($p) => $p[0] . " " . $p[1], $ring);
                if ($points[0] !== end($points)) $points[] = $points[0];
                $rings[] = "(" . implode(",", $points) . ")";
            }
            $polygons[] = "(" . implode(",", $rings) . ")";
        }
        return "MULTIPOLYGON(" . implode(",", $polygons) . ")";
    }
}

/*
https://nominatim.openstreetmap.org/ui/search.html
https://overpass-api.de/api/interpreter?data=[out:json];relation(6080948);out%20geom;
https://overpass-turbo.eu/#

osm_relation_id	bigint(20)	
update cities set osm_relation_id=6080948 where id=1;

Update a specific city: 		php artisan geometry:update --table=cities --id=1 --geojson
Update all towns: 				php artisan geometry:update --table=towns
Update a specific block: 		php artisan geometry:update --table=blocks --id=12
Update all sectors: 			php artisan geometry:update --table=sectors
*/
