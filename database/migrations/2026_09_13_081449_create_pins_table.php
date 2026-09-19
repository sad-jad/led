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
        Schema::create('pins', function (Blueprint $table) {
            $table->id();

            //اصلی
            $table->morphs('typeable');
            $table->string('name');
            $table->unsignedTinyInteger('x')->default(128);
            $table->unsignedTinyInteger('y')->default(128);
            
            $table->unique(['typeable_id', 'typeable_type', 'name']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pins');
    }
};
