<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourPreparation;

class TourPreparationSeeder extends Seeder
{
    public function run(): void
    {
        TourPreparation::create([
            'tour_id' => 1,
            'description' => 
                "- Valid passport (at least 6 months before expiry)\n" .
                "- Personal medications\n" .
                "- Light rain jacket or windbreaker\n" .
                "- Universal power adapter\n" .
                "- Power bank / mobile charger\n" .
                "- Reusable tote bag or water bottle\n" .
                "- Comfortable walking shoes"
        ]);
    }
}
