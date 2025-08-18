<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            // Put it after an existing column if you have one, otherwise just add it.
            if (Schema::hasColumn('tours', 'overview')) {
                $table->longText('faqs_json')->nullable()->after('overview');
            } else {
                $table->longText('faqs_json')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            if (Schema::hasColumn('tours', 'faqs_json')) {
                $table->dropColumn('faqs_json');
            }
        });
    }
};
