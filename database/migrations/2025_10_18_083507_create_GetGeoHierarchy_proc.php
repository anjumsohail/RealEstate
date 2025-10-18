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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `GetGeoHierarchy`(IN `in_lat` DOUBLE, IN `in_lon` DOUBLE, IN `in_radius_km` DOUBLE)
BEGIN
    SET @point = ST_GeomFromText(CONCAT('POINT(', in_lon, ' ', in_lat, ')'), 4326);
    SET @buffer_radius = in_radius_km / 111.325;

   WITH RECURSIVE geo_hierarchy AS (
    -- Cities
    SELECT
        'City' AS level,
        c.id AS id,
        c.name AS name,
        NULL AS parent_id,
        CAST(c.id AS CHAR(200)) AS path,   -- start path with city id
        ST_Distance(ST_Centroid(c.geometry), @point) * 111.325 AS distance_km,
        CASE WHEN ST_Contains(c.geometry, @point) THEN 1 ELSE 0 END AS contains_point
    FROM cities c
    WHERE 
	(MBRIntersects(c.geometry, ST_Buffer(@point, @buffer_radius))
       and ST_Distance(ST_Centroid(c.geometry), @point) * 111.325 <5
	   )
	   	   OR ST_Contains(c.geometry, @point)

    UNION ALL

    -- Towns
    SELECT
        'Town',
        t.id,
        t.name,
        t.city_id,
        CONCAT(gh.path, '/', t.id),   -- append to path
        ST_Distance(ST_Centroid(t.geometry), @point) * 111.325,
        CASE WHEN ST_Contains(t.geometry, @point) THEN 1 ELSE 0 END
    FROM towns t
    JOIN geo_hierarchy gh ON gh.level = 'City' AND gh.id = t.city_id
    WHERE 
	       (
        MBRIntersects(t.geometry, ST_Buffer(@point, @buffer_radius))
		    AND (ST_Distance(ST_Centroid(t.geometry), @point) * 111.325) < 5
    )
      OR ST_Contains(t.geometry, @point)

    UNION ALL

    -- Sectors
    SELECT
        'Sector',
        s.id,
        s.name,
        s.town_id,
        CONCAT(gh.path, '/', s.id),
        ST_Distance(ST_Centroid(s.geometry), @point) * 111.325,
        CASE WHEN ST_Contains(s.geometry, @point) THEN 1 ELSE 0 END
    FROM sectors s
    JOIN geo_hierarchy gh ON gh.level = 'Town' AND gh.id = s.town_id
    WHERE 
	(MBRIntersects(s.geometry, ST_Buffer(@point, @buffer_radius))
	   and ST_Distance(ST_Centroid(s.geometry), @point) * 111.325 <5
	   )        OR ST_Contains(s.geometry, @point)


    UNION ALL

    -- Blocks
    SELECT
        'Block',
        b.id,
        b.name,
        b.sector_id,
        CONCAT(gh.path, '/', b.id),
        ST_Distance(ST_Centroid(b.geometry), @point) * 111.325,
        CASE WHEN ST_Contains(b.geometry, @point) THEN 1 ELSE 0 END
    FROM blocks b
    JOIN geo_hierarchy gh ON gh.level = 'Sector' AND gh.id = b.sector_id
    WHERE 
	(MBRIntersects(b.geometry, ST_Buffer(@point, @buffer_radius))
	   and ST_Distance(ST_Centroid(b.geometry), @point) * 111.325 <5
	   )        OR ST_Contains(b.geometry, @point)

)
SELECT 
    level,
    id,
    name,
    parent_id,
    distance_km,
    contains_point
FROM geo_hierarchy
ORDER BY path;
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS GetGeoHierarchy");
    }
};
