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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();

        // ความสัมพันธ์
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('tour_id')->constrained()->onDelete('cascade');
        $table->foreignId('tour_departure_id')->nullable()->constrained()->onDelete('cascade');

        // ข้อมูลการจอง
        $table->integer('num_people');
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->decimal('total_price', 10, 2);
        $table->string('status')->default('pending');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
