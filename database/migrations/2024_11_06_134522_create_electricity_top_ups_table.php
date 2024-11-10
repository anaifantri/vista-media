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
        Schema::create('electricity_top_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('topup_date');
            $table->decimal('top_up_nominal',12,0)->unsigned()->default(0);
            $table->decimal('kwh_qty',8,2)->unsigned()->default(0);
            $table->string('receipt_image');
            $table->decimal('remaining_kwh_qty',8,2)->unsigned()->default(0);
            $table->string('remaining_image');
            $table->decimal('last_kwh_qty',8,2)->unsigned()->default(0);
            $table->string('last_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electricity_top_ups');
    }
};
