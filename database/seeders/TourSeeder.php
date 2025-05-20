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
            'image' => 'tours/wpk.jpg',
        ]);

        Tour::create([
            'title' => 'Angkor Wat Adventure',
            'description' => 'Discover the ancient temples of Angkor.',
            'location' => 'Siem Reap, Cambodia',
            'price' => 3200.00,
            'image' => 'tours/4.jpg',
        ]);

        Tour::create([
            'title' => 'Hanoi Explorer',
            'description' => 'Discover the charm of Hanoi and local culture.',
            'location' => 'Hanoi, Vietnam',
            'price' => 2900.00,
            'image' => 'tours/hanoi.jpg',
        ]);

        Tour::create([
            'title' => 'Luang Prabang Getaway',
            'description' => 'Relax in the peaceful city of Luang Prabang, Laos.',
            'location' => 'Luang Prabang, Laos',
            'price' => 2800.00,
            'image' => 'tours/laos.jpg',
        ]);

        Tour::create([
            'title' => 'Bangkok City Tour',
            'description' => 'Explore temples and street food in Bangkok.',
            'location' => 'Bangkok, Thailand',
            'price' => 1500.00,
            'image' => 'tours/bkk.jpg',
        ]);

        Tour::create([
            'title' => 'Angkor Wat Adventure',
            'description' => 'Discover the ancient temples of Angkor.',
            'location' => 'Siem Reap, Cambodia',
            'price' => 3200.00,
            'image' => 'tours/4.jpg',
        ]);

        Tour::create([
            'title' => 'Hanoi Explorer',
            'description' => 'Discover the charm of Hanoi and local culture.',
            'location' => 'Hanoi, Vietnam',
            'price' => 2900.00,
            'image' => 'tours/hanoi.jpg',
        ]);

        Tour::create([
            'title' => 'Luang Prabang Getaway',
            'description' => 'Relax in the peaceful city of Luang Prabang, Laos.',
            'location' => 'Luang Prabang, Laos',
            'price' => 2800.00,
            'image' => 'tours/laos.jpg',
        ]);

        Tour::create([
            'title' => 'Chiang Mai Trekking Tour',
            'description' => 'Adventure through the jungles of Northern Thailand.',
            'location' => 'Chiang Mai, Thailand',
            'price' => 3500.00,
            'image' => 'tours/chiangmai.jpg',
        ]);
    }
}
