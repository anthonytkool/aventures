<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourInclusion;



class TourInclusionSeeder extends Seeder
{
    public function run(): void
    {
        TourInclusion::create([
            'tour_id' => 1,
            'includes_insurance' => true,
            'includes_local_guide' => true,
            'includes_admission' => true,
            'notes' => 'Basic travel insurance is included for emergencies. Coverage is subject to provider terms. Activity availability may vary due to local conditions.',
        ]);
    }
}

