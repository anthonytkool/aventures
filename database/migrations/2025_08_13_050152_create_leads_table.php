<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $t) {
            $t->id();
            $t->foreignId('tour_id')->constrained()->cascadeOnDelete();
            $t->date('start_date')->nullable();
            $t->unsignedInteger('adults')->default(2);
            $t->unsignedInteger('children')->default(0);
            $t->string('hotel')->nullable();
            $t->string('pickup')->nullable();
            $t->string('name');
            $t->string('email');
            $t->string('phone')->nullable();
            $t->text('message')->nullable();
            $t->string('status')->default('new'); // new|contacted|closed
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
}
