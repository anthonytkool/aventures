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
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // เรียกใช้ Seeder อื่น ๆ
        $this->call([
            TourSeeder::class,
            TourInclusionSeeder::class,
            TourAccommodationSeeder::class,
            TourPreparationSeeder::class,
        ]);
    }
}
