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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('start_country')->nullable();
            $table->string('end_country')->nullable();
            $table->string('trip_style')->nullable(); // เช่น Classic, Active
            $table->string('difficulty')->nullable(); // เช่น Easy, Moderate
            $table->integer('min_age')->nullable();
            $table->integer('group_size')->nullable();
            $table->string('country'); // <== เพิ่มคอลัมน์นี้
            $table->string('start_location');
            $table->integer('price');
            $table->string('image_url')->nullable();
            $table->text('full_description')->nullable();
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
