<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // วาง nationality หลัง email หรือไม่ใส่ after() ก็ได้
            if (!Schema::hasColumn('leads', 'nationality')) {
                $table->string('nationality', 100)->nullable()->after('email');
            }

            if (!Schema::hasColumn('leads', 'age')) {
                $table->unsignedTinyInteger('age')->nullable()->after('nationality');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'age')) {
                $table->dropColumn('age');
            }
            if (Schema::hasColumn('leads', 'nationality')) {
                $table->dropColumn('nationality');
            }
        });
    }
};
