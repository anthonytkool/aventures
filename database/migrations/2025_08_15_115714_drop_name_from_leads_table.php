<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'name')) {
                $table->dropColumn('name');
            }
        });
    }

    public function down(): void {
        Schema::table('leads', function (Blueprint $table) {
            if (! Schema::hasColumn('leads', 'name')) {
                $table->string('name', 255)->nullable();
            }
        });
    }
};
