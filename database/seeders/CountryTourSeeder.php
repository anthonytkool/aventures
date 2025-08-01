<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\Country;

class CountryTourSeeder extends Seeder
{
    public function run(): void
    {
        // กำหนดว่าแต่ละ tour id มีประเทศอะไรบ้าง
        $mapping = [
            1 => ['thailand'],
            2 => ['thailand'],
            3 => ['thailand', 'laos'],
            4 => ['thailand'],
            5 => ['thailand', 'laos', 'vietnam'],
            6 => ['thailand'],
            7 => ['thailand'],
        ];

        foreach ($mapping as $tourId => $countrySlugs) {
            $tour = Tour::find($tourId);
            if (!$tour) continue;

            $countryIds = Country::whereIn('slug', $countrySlugs)->pluck('id');
            $tour->countries()->sync($countryIds);
        }
    }
}
