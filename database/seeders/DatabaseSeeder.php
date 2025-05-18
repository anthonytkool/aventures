<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed ผู้ใช้ทดสอบ (ไม่ซ้ำซ้อนกับอันเก่า)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed ทัวร์
        $this->call([
            TourSeeder::class,
        ]);
    }
}
