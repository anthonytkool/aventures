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
    Schema::table('tours', function (Blueprint $table) {
        $table->longText('itinerary')->nullable()->after('overview');
        $table->longText('faq')->nullable()->after('itinerary');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('tours', function (Blueprint $table) {
        $table->dropColumn(['itinerary', 'faq']);
    });
}

};
