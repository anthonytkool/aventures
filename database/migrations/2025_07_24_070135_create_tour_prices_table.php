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
    Schema::create('tour_prices', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tour_id');
        $table->unsignedInteger('pax_min');
        $table->unsignedInteger('pax_max');
        $table->decimal('price_per_person', 8, 2);
        $table->timestamps();

        // กำหนดความสัมพันธ์กับตาราง tours
        $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_prices');
    }
};
