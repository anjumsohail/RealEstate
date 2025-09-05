<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportGeometryFromFile extends Command
{
    protected $signature = 'geometry:import';
    protected $description = 'Import geometry from a GeoJSON file and update city/town/sector/block geometry column';

    public function handle()
    {
        // Ask user for table type
        $type = $this->choice(
            'Which table do you want to update?',
            ['cities', 'towns', 'sectors', 'blocks'],
            0
        );

        // Ask for record id
        $id = $this->ask('Enter the record id');

        // Ask for GeoJSON file path
        $file = $this->ask('Enter GeoJSON file path', storage_path('app/private/imports/polygon.json'));

        if (!file_exists($file)) {
            $this->error("❌ File not found: {$file}");
            return Command::FAILURE;
        }

        // Read and decode GeoJSON
        $json = file_get_contents($file);
        $data = json_decode($json, true);

        if (!$data || empty($data['features'])) {
            $this->error("❌ Invalid or empty GeoJSON file");
            return Command::FAILURE;
        }

        $geometryType = $data['features'][0]['geometry']['type'];
        $coordinates  = $data['features'][0]['geometry']['coordinates'];

        $this->info("📄 Geometry type: {$geometryType}");

        // Convert to WKT
        $wkt = null;
        if ($geometryType === 'Polygon') {
            $rings = [];
            foreach ($coordinates as $ring) {
                $points = [];
                foreach ($ring as $point) {
                    $points[] = "{$point[0]} {$point[1]}";
                }
                if ($points[0] !== end($points)) {
                    $points[] = $points[0]; // close polygon
                }
                $rings[] = "(" . implode(", ", $points) . ")";
            }
            $wkt = "POLYGON(" . implode(", ", $rings) . ")";
        } elseif ($geometryType === 'MultiPolygon') {
            $polygons = [];
            foreach ($coordinates as $polygon) {
                $rings = [];
                foreach ($polygon as $ring) {
                    $points = [];
                    foreach ($ring as $point) {
                        $points[] = "{$point[0]} {$point[1]}";
                    }
                    if ($points[0] !== end($points)) {
                        $points[] = $points[0];
                    }
                    $rings[] = "(" . implode(", ", $points) . ")";
                }
                $polygons[] = "(" . implode(", ", $rings) . ")";
            }
            $wkt = "MULTIPOLYGON(" . implode(", ", $polygons) . ")";
        } else {
            $this->error("❌ Unsupported geometry type: {$geometryType}");
            return Command::FAILURE;
        }

        // Update database
        DB::statement("
            UPDATE {$type}
            SET geometry = ST_GeomFromText(?, 4326)
            WHERE id = ?
        ", [$wkt, $id]);

        $this->info("✅ Updated {$type} id={$id} with geometry from {$file}");

        return Command::SUCCESS;
    }
}
/*
php artisan geometry:import
Which table do you want to update? [cities]:
 > cities
Enter the record id:
 > 1
Enter GeoJSON file path [storage\app\private\Imports\polygon.json]:
 > (press enter if using default)

*/


/*
SET @lat  = 32.92552374508424;
SET @lon  = 73.71921397978582;
SET @dist = 10000;

SELECT id, name,
       ST_Distance_Sphere(
           ST_Centroid(geometry),
           ST_GeomFromText(CONCAT('POINT(', @lon, ' ', @lat, ')'), 4326)
       ) AS distance_meters
FROM cities
WHERE ST_Distance_Sphere(
          ST_Centroid(geometry),
          ST_GeomFromText(CONCAT('POINT(', @lon, ' ', @lat, ')'), 4326)
      ) <= @dist;

      or
      1. Open phpMyAdmin

Select your database (the one that has your cities table).

2. Go to the SQL tab

In the top menu of phpMyAdmin, click SQL.

3. Paste the stored procedure SQL

Paste this (adjust database/table names if needed):

DELIMITER $$

CREATE PROCEDURE GetNearbyCities(
    IN in_lat DOUBLE,
    IN in_lon DOUBLE,
    IN in_dist DOUBLE
)
BEGIN
    SELECT id, name,
           ST_Distance_Sphere(
               ST_Centroid(geometry),
               ST_GeomFromText(CONCAT('POINT(', in_lon, ' ', in_lat, ')'), 4326)
           ) AS distance_meters
    FROM cities
    WHERE ST_Distance_Sphere(
              ST_Centroid(geometry),
              ST_GeomFromText(CONCAT('POINT(', in_lon, ' ', in_lat, ')'), 4326)
          ) <= in_dist
    ORDER BY distance_meters ASC;
END$$

DELIMITER ;

4. Run the query

Click Go ✅ — this will create the procedure.

5. Call the procedure in phpMyAdmin

Now, in the SQL tab again, run:

CALL GetNearbyCities(32.92552374508424, 73.71921397978582, 10000);
*/
