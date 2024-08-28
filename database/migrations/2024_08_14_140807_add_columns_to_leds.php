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
        Schema::table('leds', function (Blueprint $table) {
            $table->string('type');
            $table->string('refresh_rate');
            $table->string('pixel_config');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leds', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('refresh_rate');
            $table->dropColumn('pixel_config');
        });
    }
};
