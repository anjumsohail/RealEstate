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
        DB::unprepared("CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPropertiesInArea`(IN `in_lat` DOUBLE, IN `in_lon` DOUBLE, IN `in_radius_km` DOUBLE)
BEGIN
    SET @point = ST_GeomFromText(CONCAT('POINT(', in_lon, ' ', in_lat, ')'), 4326);
    SET @buffer_radius = in_radius_km / 111.325;

    WITH RECURSIVE geo_hierarchy AS (
        -- Cities
        SELECT 'City' AS level, c.id AS id, c.name AS name, NULL AS parent_id
        FROM cities c
        WHERE (
				MBRIntersects(c.geometry, ST_Buffer(@point, @buffer_radius))
				and ST_Distance(ST_Centroid(c.geometry), @point) * 111.325 <5
				)
           OR ST_Contains(c.geometry, @point)

        UNION ALL

        -- Towns
        SELECT 'Town', t.id, t.name, t.city_id
        FROM towns t
        JOIN geo_hierarchy gh ON gh.level = 'City' AND gh.id = t.city_id
        WHERE 
		(
		MBRIntersects(t.geometry, ST_Buffer(@point, @buffer_radius))
		and ST_Distance(ST_Centroid(t.geometry), @point) * 111.325 <5
		)
           OR ST_Contains(t.geometry, @point)

        UNION ALL

        -- Sectors
        SELECT 'Sector', s.id, s.name, s.town_id
        FROM sectors s
        JOIN geo_hierarchy gh ON gh.level = 'Town' AND gh.id = s.town_id
        WHERE 
		(
		MBRIntersects(s.geometry, ST_Buffer(@point, @buffer_radius))
		and ST_Distance(ST_Centroid(s.geometry), @point) * 111.325 <5
		)
           OR ST_Contains(s.geometry, @point)

        UNION ALL

        -- Blocks
        SELECT 'Block', b.id, b.name, b.sector_id
        FROM blocks b
        JOIN geo_hierarchy gh ON gh.level = 'Sector' AND gh.id = b.sector_id
        WHERE (
		MBRIntersects(b.geometry, ST_Buffer(@point, @buffer_radius))
		and ST_Distance(ST_Centroid(b.geometry), @point) * 111.325 <5
		)
           OR ST_Contains(b.geometry, @point)
    )

    SELECT 
        pa.id,
        pa.category,
        pa.proptype,
        pa.title,
        pa.description,
        pa.address,
        pa.area_size,
        pa.size_unit,
        pa.demand_price,
        pa.bedrooms,
        pa.front_face,
        COALESCE(pp.first_image, 'property_images/Default.jpg') AS image_path
    FROM property_advertisements pa
    LEFT JOIN (
        SELECT 
            property_advertisement_id,
            MIN(image_path) AS first_image
        FROM property_pictures
        WHERE image_path IS NOT NULL
        GROUP BY property_advertisement_id
    ) pp ON pa.id = pp.property_advertisement_id
    WHERE
        -- Match if property’s own lat/lon is within radius
        ST_Distance(
            ST_GeomFromText(CONCAT('POINT(', pa.longitude, ' ', pa.latitude, ')'), 4326),
            @point
        ) * 111.325 <= in_radius_km

        OR pa.city_id IN (SELECT id FROM geo_hierarchy WHERE level = 'City')
        OR pa.town_id IN (SELECT id FROM geo_hierarchy WHERE level = 'Town')
        OR pa.sector_id IN (SELECT id FROM geo_hierarchy WHERE level = 'Sector')
        OR pa.block_id IN (SELECT id FROM geo_hierarchy WHERE level = 'Block');
END");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS GetPropertiesInArea");
    }
};
