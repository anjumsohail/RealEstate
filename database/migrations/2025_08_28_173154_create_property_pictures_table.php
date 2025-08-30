<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('property_pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_advertisement_id');
            $table->string('title')->nullable();
            $table->string('image_path'); // store path like storage/app/public/property_images/xxx.jpg
            $table->timestamps();

            $table->foreign('property_advertisement_id')
                  ->references('id')
                  ->on('property_advertisements')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_pictures');
    }
};
