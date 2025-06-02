<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tour;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        // ปิด foreign key checks ชั่วคราว
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Tour::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Tour::create([
            'title' => 'Bangkok City Tour',
            'country' => 'Thailand',
            'start_location' => 'Bangkok',
            'price' => 3200,
            'image_url' => 'storage/tours/bangkok.jpg', // ✅ ต้องใส่แบบนี้
            'full_description' => 'Explore temples, tuk-tuks, and street food in Bangkok.',
        ]);

        Tour::create([
            'title' => 'Chiang Mai Trekking Tour',
            'country' => 'Thailand',
            'start_location' => 'Chiang Mai',
            'price' => 3500,
            'image_url' => 'storage/tours/chiangmai.jpg',
            'full_description' => 'Trek through the northern Thai jungle and hilltribes.',
        ]);

        Tour::create([
            'title' => 'Angkor Wat Adventure',
            'country' => 'Cambodia',
            'start_location' => 'Siem Reap',
            'price' => 2900,
            'image_url' => 'storage/tours/angkor.jpg',
            'full_description' => 'Discover the majestic Angkor Wat and ancient temples.',
        ]);

        Tour::create([
            'title' => 'Hanoi Explorer',
            'country' => 'Vietnam',
            'start_location' => 'Hanoi',
            'price' => 2900,
            'image_url' => 'storage/tours/hanoi.jpg',
            'full_description' => 'Enjoy the charm of Hanoi, street food, and Old Quarter.',
        ]);

        Tour::create([
            'title' => 'Luang Prabang Getaway',
            'country' => 'Laos',
            'start_location' => 'Luang Prabang',
            'price' => 2800,
            'image_url' => 'storage/tours/laos.jpg',
            'full_description' => 'Relax by the Mekong, waterfalls, and Buddhist temples.',
        ]);
    }
}
