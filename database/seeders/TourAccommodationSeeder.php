<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourAccommodation;



class TourAccommodationSeeder extends Seeder
{
    public function run(): void
    {
        TourAccommodation::insert([
            [
                'tour_id' => 1,
                'day_number' => 1,
                'stars' => 3,
                'shared_room' => true,
                'single_supplement_price' => 120.00,
            ],
            [
                'tour_id' => 1,
                'day_number' => 2,
                'stars' => 2,
                'shared_room' => true,
                'single_supplement_price' => 100.00,
            ],
        ]);
    }
}

