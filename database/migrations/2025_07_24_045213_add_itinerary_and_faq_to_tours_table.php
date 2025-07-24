<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            if (!Schema::hasColumn('tours', 'itinerary')) {
                $table->longText('itinerary')->nullable()->after('description');
            }

            if (!Schema::hasColumn('tours', 'faq')) {
                $table->longText('faq')->nullable()->after('itinerary');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            if (Schema::hasColumn('tours', 'itinerary')) {
                $table->dropColumn('itinerary');
            }

            if (Schema::hasColumn('tours', 'faq')) {
                $table->dropColumn('faq');
            }
        });
    }
};
