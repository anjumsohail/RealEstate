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
            $table->id();
            $table->enum('purpose', ['Sale', 'Rent']);
            $table->enum('category', ['Residential', 'Commercial']);
            $table->enum('type', ['Plot', 'Home', 'Apartment', 'Portion', 'Cottage']);
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('city');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('area_size', 10, 2);
            $table->enum('size_unit', ['Sqr yard', 'Sqr feet', 'Marla', 'Kanal']);
            $table->enum('positioning', ['East Open', 'West Open', 'North Open', 'South Open'])->nullable();
            $table->string('front_face')->nullable();
            $table->string('back_site')->nullable();
            $table->decimal('demand_price', 15, 2);
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_users');
    }
};
