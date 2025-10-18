<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BusinessUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('business_users')->delete();
        
        \DB::table('business_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'business_nature' => '["Real Estate Agent","Home Interior \\/ Exterior"]',
                'company_name' => 'Anjumnet',
                'company_description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
                'designation' => 'Sr. Tech Officer',
                'city_id' => 1,
                'services' => '["Sales Purchase","Property Rental","Real Estate Marketing","Interior Designer"]',
                'facebook_url' => 'https://www.facebook.com/anjumsohail',
                'youtube_url' => 'https://www.youtube.com/anjumsohail',
                'linkedin_url' => 'https://www.linkedin.com/anjumsohail',
                'latitude' => '24.9437482',
                'longitude' => '67.1662045',
                'logo' => 'profile-photos/3A0OeoFa3zb0AxyJyw0ZwXVxKdqeEoeMbRip18Xn.png',
                'vcard' => 'profile-photos/O2dCri89JOkWtCflxBoZdvp5IunOJ6IQUuXOc2px.png',
                'created_at' => '2025-10-16 03:57:34',
                'updated_at' => '2025-10-18 08:10:31',
            ),
        ));
        
        
    }
}