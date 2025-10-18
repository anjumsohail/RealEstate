<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PropertyPicturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('property_pictures')->delete();
        
        \DB::table('property_pictures')->insert(array (
            0 => 
            array (
                'id' => 26,
                'property_advertisement_id' => 53,
                'title' => 'Main Entry',
                'image_path' => 'property_images/YAEGMhjMavfhUKM9UWehBPRTP20yhaIYHg55lqWI.jpg',
                'created_at' => '2025-10-02 00:00:37',
                'updated_at' => '2025-10-02 00:00:37',
            ),
            1 => 
            array (
                'id' => 27,
                'property_advertisement_id' => 54,
                'title' => 'Pool Side',
                'image_path' => 'property_images/OXVw3nvIOP5UFIjYv7cnur0psWbo1LWhA9mGOeiB.jpg',
                'created_at' => '2025-10-02 00:02:43',
                'updated_at' => '2025-10-02 00:02:43',
            ),
            2 => 
            array (
                'id' => 28,
                'property_advertisement_id' => 55,
                'title' => 'Enterance',
                'image_path' => 'property_images/1zKXMkfRt56VsFYRuMBGPyNyIJuxjrzV2WOnrtT8.png',
                'created_at' => '2025-10-07 23:15:59',
                'updated_at' => '2025-10-07 23:15:59',
            ),
            3 => 
            array (
                'id' => 29,
                'property_advertisement_id' => 55,
                'title' => 'Side view',
                'image_path' => 'property_images/rbB04wQdZB2OdhLqpxBFudo7yPhpkuG9MUKqftWK.png',
                'created_at' => '2025-10-07 23:15:59',
                'updated_at' => '2025-10-07 23:15:59',
            ),
            4 => 
            array (
                'id' => 30,
                'property_advertisement_id' => 55,
                'title' => 'Dining Room',
                'image_path' => 'property_images/6D8eCkckqDVUxMPobHzFWcVZt96Ma5XXv9RhXi4X.png',
                'created_at' => '2025-10-07 23:15:59',
                'updated_at' => '2025-10-07 23:15:59',
            ),
            5 => 
            array (
                'id' => 31,
                'property_advertisement_id' => 55,
                'title' => 'Kitchen',
                'image_path' => 'property_images/rm30SdImyTOViq1A3yUfwIyaufZx7v78JH3FzKLM.png',
                'created_at' => '2025-10-07 23:16:00',
                'updated_at' => '2025-10-07 23:16:00',
            ),
            6 => 
            array (
                'id' => 32,
                'property_advertisement_id' => 56,
                'title' => 'Front view',
                'image_path' => 'property_images/KLRJLfg8qQj5tE8rqahohdLY4rBsv6fyR9nacvok.png',
                'created_at' => '2025-10-07 23:20:32',
                'updated_at' => '2025-10-07 23:20:32',
            ),
            7 => 
            array (
                'id' => 33,
                'property_advertisement_id' => 56,
                'title' => 'Kitchen',
                'image_path' => 'property_images/FqgVTxVHf0iS7Gzv7aMqPtL47qKAzHFQBhtc01PS.png',
                'created_at' => '2025-10-07 23:20:32',
                'updated_at' => '2025-10-07 23:20:32',
            ),
            8 => 
            array (
                'id' => 34,
                'property_advertisement_id' => 56,
                'title' => 'Washroom',
                'image_path' => 'property_images/vc9M5JrjkDHOn6X2hNFXAiF92eA2m6ebooXVPe51.png',
                'created_at' => '2025-10-07 23:20:33',
                'updated_at' => '2025-10-07 23:20:33',
            ),
            9 => 
            array (
                'id' => 35,
                'property_advertisement_id' => 57,
                'title' => 'Entry Gate',
                'image_path' => 'property_images/cFaQcGhZ2xRdPmN5Yz2NX1mdxn8yZyJgjJhLGJNg.png',
                'created_at' => '2025-10-07 23:22:44',
                'updated_at' => '2025-10-07 23:22:44',
            ),
            10 => 
            array (
                'id' => 36,
                'property_advertisement_id' => 57,
                'title' => 'Kitchen',
                'image_path' => 'property_images/N7K3dYTJBDEZ0ZDUow6Jt203rbqWvfpRtVUGVLCn.png',
                'created_at' => '2025-10-07 23:22:44',
                'updated_at' => '2025-10-07 23:22:44',
            ),
            11 => 
            array (
                'id' => 37,
                'property_advertisement_id' => 57,
                'title' => 'Bedroom',
                'image_path' => 'property_images/Gth83iqmy6C5dSNVM2npUT0T99CohjG8TBDlheso.png',
                'created_at' => '2025-10-07 23:22:44',
                'updated_at' => '2025-10-07 23:22:44',
            ),
            12 => 
            array (
                'id' => 38,
                'property_advertisement_id' => 57,
                'title' => 'BathRoom',
                'image_path' => 'property_images/qB3T80YWmExpRsdHm0qerDMnJRB3fGGGg03fakvq.png',
                'created_at' => '2025-10-07 23:22:45',
                'updated_at' => '2025-10-07 23:22:45',
            ),
            13 => 
            array (
                'id' => 39,
                'property_advertisement_id' => 58,
                'title' => 'Front View',
                'image_path' => 'property_images/qEo4fqvQGWRvjpFbzPxHiqBEpaqwkigTP3JLkoDj.png',
                'created_at' => '2025-10-07 23:24:24',
                'updated_at' => '2025-10-07 23:24:24',
            ),
        ));
        
        
    }
}