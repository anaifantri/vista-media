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
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->integer('pixel_pitch');
            $table->integer('pixel_density');
            $table->integer('module_width');
            $table->integer('module_height');
            $table->integer('cabinet_width');
            $table->integer('cabinet_height');
            $table->string('cabinet_material');
            $table->integer('cabinet_weight');
            $table->integer('front_protection')->nullable();
            $table->integer('back_protection')->nullable();
            $table->string('optimal_distance');
            $table->string('vertical_angle');
            $table->string('horizontal_angle');
            $table->integer('max_power');
            $table->integer('average_power');
            $table->integer('brightness');
            $table->string('type');
            $table->integer('refresh_rate');
            $table->string('pixel_config');
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
