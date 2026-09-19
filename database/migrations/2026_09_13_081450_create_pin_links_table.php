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
        Schema::create('pin_links', function (Blueprint $table) {
            $table->id();

            //اصلی
            $table->foreignId('boardable_id')->constrained('boardables')->onDelete('cascade');
            $table->foreignId('pin_id')->constrained('pins')->onDelete('cascade');
            $table->foreignId('love_id')->constrained('pins')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pin_links');
    }
};
