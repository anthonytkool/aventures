<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('country')->default('Thailand');
            $table->string('destination')->default('Bangkok'); // ✅ เพิ่ม default ป้องกัน error
            $table->string('start_location')->nullable(); // ✅ ใช้ร่วมกับ TourSeeder
            $table->decimal('base_price', 10, 2)->default(0); // ✅ เพื่อความปลอดภัย
            $table->decimal('price', 10, 2)->nullable();
            $table->string('image_url')->nullable();
            $table->text('full_description')->nullable();
            $table->integer('duration')->default(1); // ✅ วันเริ่มต้นขั้นต่ำ
            $table->text('overview')->nullable();
            $table->text('highlights')->nullable();
            $table->string('physical_rating')->nullable();
            $table->string('tour_type')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
