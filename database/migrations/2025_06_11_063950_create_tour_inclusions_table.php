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
    Schema::create('tour_inclusions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('tour_id')->constrained('tours')->onDelete('cascade');
        $table->boolean('includes_insurance')->default(false);
        $table->boolean('includes_local_guide')->default(false);
        $table->boolean('includes_admission')->default(false);
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_inclusions');
    }
};
