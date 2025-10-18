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
        Schema::table('property_pictures', function (Blueprint $table) {
            $table->foreign(['property_advertisement_id'])->references(['id'])->on('property_advertisements')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_pictures', function (Blueprint $table) {
            $table->dropForeign('property_pictures_property_advertisement_id_foreign');
        });
    }
};
