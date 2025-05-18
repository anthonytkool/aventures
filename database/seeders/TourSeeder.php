<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        Tour::create([
            'title' => 'Bangkok City Tour',
            'description' => 'Explore temples and street food in Bangkok.',
            'location' => 'Bangkok, Thailand',
            'price' => 1500.00,
            'image' => 'tours/bkk.jpg', // เราจะสร้างโฟลเดอร์นี้ทีหลัง
        ]);

        Tour::create([
            'title' => 'Angkor Wat Adventure',
            'description' => 'Discover the ancient temples of Angkor.',
            'location' => 'Siem Reap, Cambodia',
            'price' => 3200.00,
            'image' => 'tours/4.jpg',
        ]);
    }
}

