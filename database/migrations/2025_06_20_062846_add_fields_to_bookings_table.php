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
        
{
    Schema::table('bookings', function (Blueprint $table) {
    if (!Schema::hasColumn('bookings', 'tour_departure_id')) {
        $table->unsignedInteger('tour_departure_id')->nullable();
    }
    if (!Schema::hasColumn('bookings', 'passport_number')) {
        $table->string('passport_number')->nullable();
    }
    if (!Schema::hasColumn('bookings', 'whatsapp')) {
        $table->string('whatsapp')->nullable();
    }
    if (!Schema::hasColumn('bookings', 'adults')) {
        $table->integer('adults')->default(1);
    }
    if (!Schema::hasColumn('bookings', 'children')) {
        $table->integer('children')->default(0);
    }
    if (!Schema::hasColumn('bookings', 'num_people')) {
        $table->integer('num_people')->default(1);
    }
    if (!Schema::hasColumn('bookings', 'total_price')) {
        $table->decimal('total_price', 10, 2)->default(0);
    }
});
        
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
};
