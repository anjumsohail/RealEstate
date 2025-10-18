<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `GetNearbyCities`(IN `in_lat` DOUBLE, IN `in_lon` DOUBLE, IN `in_dist` DOUBLE)
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
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS GetNearbyCities");
    }
};
