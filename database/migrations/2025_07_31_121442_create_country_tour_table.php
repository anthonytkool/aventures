<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            ['name' => 'Thailand', 'slug' => 'thailand'],
            ['name' => 'Laos', 'slug' => 'laos'],
            ['name' => 'Vietnam', 'slug' => 'vietnam'],
        ];

        foreach ($countries as $data) {
            Country::firstOrCreate(['slug' => $data['slug']], $data);
        }
    }
}
