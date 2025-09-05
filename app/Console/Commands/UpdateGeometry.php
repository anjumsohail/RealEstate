<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UpdateGeometry extends Command
{
    protected $signature = 'geometry:update {--table=} {--id=}';
    protected $description = 'Fetch OSM relation or way polygon and update geometry column for cities, towns, sectors, or blocks';

    public function handle()
    {
        $table = $this->option('table');
        $id    = $this->option('id');

        if (!$table || !in_array($table, ['cities', 'towns', 'sectors', 'blocks'])) {
            $this->error("Please provide --table=cities|towns|sectors|blocks");
            return;
        }

        $this->info("=== Processing table: {$table}" . ($id ? " (id={$id})" : " (all)") . " ===");

        $query = DB::table($table)
            ->when($id, fn($q) => $q->where('id', $id))
            ->whereNotNull('osm_relation_id') // or osm_way_id if you store it
            ->where('osm_relation_id', '>', 0)   // skip invalid ids
            ->get();

        foreach ($query as $row) {
            $osmId = $row->osm_relation_id; // or osm_way_id if you have that separately
            $type  = $this->detectOSMType($osmId); // returns 'relation' or 'way'

            if (!$type) {
                $this->warn("⚠️ Cannot detect OSM type for {$table} id={$row->id} (OSM={$osmId})");
                continue;
            }

            $this->info("📡 Fetching OSM {$type} {$osmId} for {$table} id={$row->id}");

            $data = $this->fetchGeometryFromOSM($osmId, $type);

            if (!$data || empty($data['elements'])) {
                $this->info("Data fetch{$data}");
                $this->error("❌ Overpass request failed for {$table} id={$row->id} (OSM={$osmId})");
                continue;
            }

            // Save raw GeoJSON
            $dir = "{$table}";
            Storage::makeDirectory($dir);
            Storage::put("{$dir}/{$row->id}.json", json_encode($data, JSON_PRETTY_PRINT));

            // Convert to WKT
            $wkt = $this->convertToWKT($data);

            if (!$wkt) {
                $this->warn("⚠️ No polygon/multipolygon geometry found for {$table} id={$row->id}");
                continue;
            }

            // Update DB
            DB::statement("
                UPDATE {$table}
                SET geometry = ST_GeomFromText(?, 4326)
                WHERE id = ?
            ", [$wkt, $row->id]);

            $this->info("✅ Updated {$table} id={$row->id} with geometry");
        }

        $this->info("Done.");
    }

    protected function detectOSMType($osmId)
{
    // Try relation first
    $types = ['R', 'W']; // R=relation, W=way
    foreach ($types as $type) {
        $url = "https://nominatim.openstreetmap.org/lookup?format=json&osm_ids={$type}{$osmId}";
        $response = Http::withHeaders([
            'User-Agent' => 'MyLaravelApp/1.0'
        ])->timeout(30)->get($url);

        if (!$response->ok()) {
            continue;
        }

        $json = $response->json();
        if (!empty($json) && isset($json[0]['osm_type'])) {
            return $json[0]['osm_type'] === 'way' ? 'way' : ($json[0]['osm_type'] === 'relation' ? 'relation' : null);
        }
    }

    return null; // Could not detect
}

    protected function fetchGeometryFromOSM($osmId, $type)
    {
        $url   = "https://overpass-api.de/api/interpreter";
        $query = "[out:json];{$type}({$osmId});out geom;";

        $response = Http::timeout(60)->get($url, ['data' => $query]);

        if (!$response->ok()) return null;

        return $response->json();
    }

    protected function convertToWKT($data)
    {
        $polygons = [];

        foreach ($data['elements'] as $element) {
            if (!isset($element['members'])) {
                // For way, geometry is directly in element['geometry']
                if (isset($element['geometry'])) {
                    $coords = [];
                    foreach ($element['geometry'] as $point) {
                        $coords[] = "{$point['lon']} {$point['lat']}";
                    }
                    if ($coords[0] !== end($coords)) $coords[] = $coords[0];
                    $polygons[] = "((" . implode(", ", $coords) . "))";
                }
                continue;
            }

            foreach ($element['members'] as $member) {
                if (!isset($member['geometry'])) continue;

                $coords = [];
                foreach ($member['geometry'] as $point) {
                    $coords[] = "{$point['lon']} {$point['lat']}";
                }
                if ($coords[0] !== end($coords)) $coords[] = $coords[0];
                $polygons[] = "((" . implode(", ", $coords) . "))";
            }
        }

        if (count($polygons) === 0) return null;
        if (count($polygons) === 1) return "POLYGON{$polygons[0]}";

        return "MULTIPOLYGON(" . implode(", ", $polygons) . ")";
    }
}


/*
https://nominatim.openstreetmap.org/ui/search.html
osm_relation_id	bigint(20)	
update cities set osm_relation_id=6080948 where id=1;

Update a specific city: 		php artisan geometry:update --table=cities --id=1
Update all towns: 				php artisan geometry:update --table=towns
Update a specific block: 		php artisan geometry:update --table=blocks --id=12
Update all sectors: 			php artisan geometry:update --table=sectors
*/
