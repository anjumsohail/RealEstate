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
        Schema::table('property_advertisements', function (Blueprint $table) {
            // Remove old city column if exists
            if (Schema::hasColumn('property_advertisements', 'city')) {
                $table->dropColumn('city');
            }

            // Add new foreign keys
            $table->unsignedBigInteger('city_id')->after('id');
            $table->unsignedBigInteger('town_id')->nullable()->after('city_id');
            $table->unsignedBigInteger('sector_id')->nullable()->after('town_id');
            $table->unsignedBigInteger('block_id')->nullable()->after('sector_id');

            // Foreign key constraints
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('town_id')->references('id')->on('towns')->onDelete('set null');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('set null');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_advertisements', function (Blueprint $table) {
            // Drop foreign keys first
            $table->dropForeign(['city_id']);
            $table->dropForeign(['town_id']);
            $table->dropForeign(['sector_id']);
            $table->dropForeign(['block_id']);

            // Drop the columns
            $table->dropColumn(['city_id', 'town_id', 'sector_id', 'block_id']);

            // Restore old city column if needed
            $table->string('city')->nullable();
        });
    }
};
