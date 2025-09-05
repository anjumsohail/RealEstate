<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class UpdateCityGeometry extends Command
{
    protected $signature = 'cities:update-geometry {--id=}';
    protected $description = 'Fetch OSM relation polygon and update geometry column in cities table';

    public function handle()
    {
        $cityId = $this->option('id');

        $query = DB::table('cities')
            ->when($cityId, fn($q) => $q->where('id', $cityId))
            ->whereNotNull('osm_relation_id')
            ->get();

        foreach ($query as $city) {
            $relationId = $city->osm_relation_id;

            $this->info("📡 Fetching OSM relation: {$relationId} for city: {$city->id}");

            // Call Overpass API
            $url = "https://overpass-api.de/api/interpreter?data=[out:json];relation({$relationId});out geom;";
            $response = Http::get($url);

            if (!$response->ok()) {
                $this->error("❌ Failed to fetch data for city {$city->id}");
                continue;
            }

            $data = $response->json();

            if (empty($data['elements'])) {
                $this->warn("⚠️ No geometry found for city {$city->id}");
                continue;
            }

            // Save raw JSON for inspection
            Storage::disk('local')->put("cities/{$city->id}.json", json_encode($data, JSON_PRETTY_PRINT));
            $this->line("💾 Raw JSON saved at storage/app/cities/{$city->id}.json");

            $polygons = [];

            // Case 1: Single polygon directly
            if (isset($data['elements'][0]['geometry'])) {
                $coords = [];
                foreach ($data['elements'][0]['geometry'] as $point) {
                    $coords[] = "{$point['lon']} {$point['lat']}";
                }
                if ($coords[0] !== end($coords)) {
                    $coords[] = $coords[0];
                }
                $polygons[] = "((" . implode(", ", $coords) . "))";
            }

            // Case 2: Multipolygon members
            if (isset($data['elements'][0]['members'])) {
                foreach ($data['elements'][0]['members'] as $member) {
                    if ($member['role'] === 'outer' && isset($member['geometry'])) {
                        $coords = [];
                        foreach ($member['geometry'] as $point) {
                            $coords[] = "{$point['lon']} {$point['lat']}";
                        }
                        if ($coords[0] !== end($coords)) {
                            $coords[] = $coords[0];
                        }
                        $polygons[] = "((" . implode(", ", $coords) . "))";
                    }
                }
            }

            // Build WKT
            if (count($polygons) === 0) {
                $this->warn("⚠️ No polygon geometry found for city {$city->id}");
                continue;
            } elseif (count($polygons) === 1) {
                $wkt = "POLYGON" . $polygons[0];
                $this->info("✅ City {$city->id}: Single polygon saved");
            } else {
                $wkt = "MULTIPOLYGON(" . implode(", ", $polygons) . ")";
                $this->info("✅ City {$city->id}: Detected multipolygon with " . count($polygons) . " parts");
            }

            // Debug: log first 3 points
            preg_match_all('/([0-9\.\-]+ [0-9\.\-]+)/', $polygons[0], $matches);
            $samplePoints = array_slice($matches[0], 0, 3);
            $this->line("🔍 Sample coordinates: " . implode(" | ", $samplePoints));

            // Update DB
            DB::statement("
                UPDATE cities
                SET geometry = ST_GeomFromText(?, 4326)
                WHERE id = ?
            ", [$wkt, $city->id]);

            $this->info("💾 Updated city {$city->id} with geometry");
        }
    }
}

/*
Update all towns:           php artisan towns:update-geometry
Update a specific town:     php artisan towns:update-geometry --id=5
Update all cities:          php artisan cities:update-geometry
Update a specific city:     php artisan cities:update-geometry --id=1
*/
