<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
                    // OSM relation id (nullable, not necessarily unique — a city may share a relation sometimes)
        $table->bigInteger('osm_relation_id')->nullable();
        // Geometry column with SRID 4326
        $table->geometry('boundary', 4326);
        // Spatial index for efficient geo queries
        $table->spatialIndex('boundary', 'towns_geometry_spatial_index');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('towns');
    }
};
