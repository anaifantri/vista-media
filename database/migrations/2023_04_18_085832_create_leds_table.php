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
        Schema::create('leds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('name')->unique();
            $table->string('pixel_pitch');
            $table->string('pixel_density');
            $table->string('module_size');
            $table->string('cabinet_size');
            $table->string('cabinet_material');
            $table->string('cabinet_weight');
            $table->string('protective_grade');
            $table->string('view_distancing');
            $table->string('view_angle_v');
            $table->string('view_angle_h');
            $table->string('max_power');
            $table->string('average_power');
            $table->string('brightness');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leds');
    }
};
