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
            $table->string('pricetype')->nullable()->after('demand_price');
            $table->string('floor')->nullable()->after('pricetype');
            $table->string('bedrooms')->nullable()->after('floor');
            $table->string('consage')->nullable()->after('bedrooms');
            $table->string('conscond')->nullable()->after('consage');
            $table->string('postas')->nullable()->after('conscond');
            $table->string('social')->nullable()->after('postas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('property_advertisements', function (Blueprint $table) {
            $table->dropColumn([
                'pricetype',
                'floor',
                'bedrooms',
                'consage',
                'conscond',
                'demand_price',
                'postas',
                'social',
            ]);
        });
    }
};
