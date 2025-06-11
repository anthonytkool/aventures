<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tour_accommodations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tour_id')->constrained('tours')->onDelete('cascade');
        $table->unsignedTinyInteger('day_number');
        $table->unsignedTinyInteger('stars')->default(2);
        $table->boolean('shared_room')->default(true);
        $table->decimal('single_supplement_price', 8, 2)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_accommodations');
    }
};
