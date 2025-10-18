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
        Schema::create('property_advertisements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('city_id')->index('property_advertisements_city_id_foreign');
            $table->unsignedBigInteger('town_id')->nullable()->index('property_advertisements_town_id_foreign');
            $table->unsignedBigInteger('sector_id')->nullable()->index('property_advertisements_sector_id_foreign');
            $table->unsignedBigInteger('block_id')->nullable()->index('property_advertisements_block_id_foreign');
            $table->enum('purpose', ['Sale', 'Rent']);
            $table->enum('category', ['Residential', 'Commercial']);
            $table->enum('proptype', ['Plot', 'Home', 'Apartment', 'Portion', 'Cottage']);
            $table->boolean('featured')->default(false);
            $table->boolean('approved')->default(false);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('area_size', 10);
            $table->text('size_unit');
            $table->enum('positioning', ['East Open', 'West Open', 'North Open', 'South Open'])->nullable();
            $table->string('front_face')->nullable();
            $table->string('back_site')->nullable();
            $table->decimal('demand_price', 15);
            $table->string('pricetype')->nullable();
            $table->string('housetype');
            $table->string('floor')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('consage')->nullable();
            $table->string('conscond')->nullable();
            $table->string('postas')->nullable();
            $table->string('social')->nullable();
            $table->unsignedBigInteger('user_id')->index('property_advertisements_user_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_advertisements');
    }
};
