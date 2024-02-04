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
        Schema::create('videotrons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('size_id')->constrained();
            $table->foreignId('led_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->integer('slots');
            $table->integer('duration');
            $table->time('start_at', $precision = 0)->nullable();
            $table->time('end_at', $precision = 0)->nullable();
            $table->string('condition');
            $table->string('road_segment');
            $table->string('max_distance');
            $table->string('speed_average');
            $table->string('sector');
            $table->decimal('price',12,0)->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videotrons');
    }
};
