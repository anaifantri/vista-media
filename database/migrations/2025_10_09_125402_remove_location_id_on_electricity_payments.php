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
        Schema::table('electricity_payments', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
            $table->foreignId('electrical_power_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('electricity_payments', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained();
            $table->dropForeign(['electrical_power_id']);
            $table->dropColumn('electrical_power_id');
        });
    }
};
