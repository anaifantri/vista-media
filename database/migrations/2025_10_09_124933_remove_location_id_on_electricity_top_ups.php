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
        Schema::table('electricity_top_ups', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
            $table->foreignId('electrical_power_id')->nullable()->constrained();
            $table->string('remaining_kwh_qty')->nullable()->change();
            $table->string('remaining_image')->nullable()->change();
            $table->string('last_kwh_qty')->nullable()->change();
            $table->string('last_image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electricity_top_ups', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained();
            $table->dropForeign(['electrical_power_id']);
            $table->dropColumn('electrical_power_id');
            $table->string('remaining_kwh_qty')->nullable(false)->change();
            $table->string('remaining_image')->nullable(false)->change();
            $table->string('last_kwh_qty')->nullable(false)->change();
            $table->string('last_image')->nullable(false)->change();
        });
    }
};
