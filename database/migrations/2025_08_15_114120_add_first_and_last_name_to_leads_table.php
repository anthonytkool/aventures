<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            // เพิ่ม first_name ถ้ายังไม่มี
            if (! Schema::hasColumn('leads', 'first_name')) {
                $table->string('first_name', 120)->after('id');
            }

            // เพิ่ม last_name ถ้ายังไม่มี
            if (! Schema::hasColumn('leads', 'last_name')) {
                $table->string('last_name', 120)->after('first_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (Schema::hasColumn('leads', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if (Schema::hasColumn('leads', 'first_name')) {
                $table->dropColumn('first_name');
            }
        });
    }
};
