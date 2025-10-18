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
        Schema::create('blocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->bigInteger('osm_relation_id');
            $table->geometry('geometry');
            $table->unsignedBigInteger('sector_id')->index('blocks_sector_id_foreign');
            $table->timestamps();

            $table->spatialIndex(['geometry'], 'blocks_geometry_spatial_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
