<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_type' => 'Business',
                'name' => 'Anjum Sohail',
                'email' => 'itdanjum@gmail.com',
                'mobile' => '923180224024',
                'address' => 'A-46, Rufi Homes, Near Safooa Chowrangi',
                'profile_photo_path' => 'profile-photos/hgM4a7kc0YSEjDlnIwP6pWBz9ZkSeRWq5jwnn4Ez.jpg',
                'landline' => '02134646309',
                'whatsapp' => '92318022422',
                'email_verified_at' => NULL,
                'password' => '$2y$12$p3gAmW8R.kFx1Y2L1YBITuigJ1d6aPKk3r7XbMd4ZchxVwWdu9DUa',
                'two_factor_secret' => NULL,
                'two_factor_recovery_codes' => NULL,
                'two_factor_confirmed_at' => NULL,
                'remember_token' => 't9kaSDZwCepmgFWzRRFX6nu42Ml2QQvK9JcKQW3S6LCUuOeCAHXjIt059Ksh',
                'created_at' => '2025-08-14 10:01:26',
                'updated_at' => '2025-10-18 08:10:31',
            ),
        ));
        
        
    }
}