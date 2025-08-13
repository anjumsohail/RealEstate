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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_type', ['Individual', 'Business'])->after('id');
            $table->string('mobile')->unique()->after('email');
            $table->string('address')->nullable()->after('mobile');
            $table->string('profile_photo')->nullable()->after('address');
            $table->string('landline')->nullable()->after('profile_photo');
            $table->string('whatsapp')->nullable()->after('landline');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'user_type',
                'mobile',
                'address',
                'profile_photo',
                'landline',
                'whatsapp'
            ]);
        });
    }
};
