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
        Schema::create('boardables', function (Blueprint $table) {
            $table->id();

            //اصلی            
            $table->foreignId('board_id')->constrained('boards')->onDelete('cascade');
            $table->morphs('boardable');
            $table->nullableMorphs('refable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boardables');
    }
};
