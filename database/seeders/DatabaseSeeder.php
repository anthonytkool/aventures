<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // เพิ่ม User ทดสอบ (ถ้ายังไม่มี)
        User::firstOrCreate(
    ['email' => 'test@example.com'],
    ['name' => 'Test User']
);

        // เรียกใช้ Seeder อื่น ๆ
        $this->call([
            TourSeeder::class,
            TourInclusionSeeder::class,
            TourAccommodationSeeder::class,
            TourPreparationSeeder::class,
            CountrySeeder::class,
            CountryTourSeeder::class,
        ]);
    }
}
