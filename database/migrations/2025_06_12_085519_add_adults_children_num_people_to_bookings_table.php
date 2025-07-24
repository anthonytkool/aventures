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
    Schema::table('bookings', function (Blueprint $table) {
        if (!Schema::hasColumn('bookings', 'adults')) {
            $table->integer('adults')->default(1)->after('nationality');
        }
        if (!Schema::hasColumn('bookings', 'children')) {
            $table->integer('children')->default(0)->after('adults');
        }
        if (!Schema::hasColumn('bookings', 'num_people')) {
            $table->integer('num_people')->nullable()->after('children');
        }
    });
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
