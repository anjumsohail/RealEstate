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
            $table->foreign(['block_id'])->references(['id'])->on('blocks')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['city_id'])->references(['id'])->on('cities')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign(['sector_id'])->references(['id'])->on('sectors')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['town_id'])->references(['id'])->on('towns')->onUpdate('restrict')->onDelete('set null');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_advertisements', function (Blueprint $table) {
            $table->dropForeign('property_advertisements_block_id_foreign');
            $table->dropForeign('property_advertisements_city_id_foreign');
            $table->dropForeign('property_advertisements_sector_id_foreign');
            $table->dropForeign('property_advertisements_town_id_foreign');
            $table->dropForeign('property_advertisements_user_id_foreign');
        });
    }
};
