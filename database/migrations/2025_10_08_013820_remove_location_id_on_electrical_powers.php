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
        Schema::table('electrical_powers', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
            $table->foreignId('area_id')->nullable()->constrained();
            $table->foreignId('city_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electrical_powers', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained();
            $table->dropForeign(['area_id']);
            $table->dropColumn('area_id');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
        });
    }
};
