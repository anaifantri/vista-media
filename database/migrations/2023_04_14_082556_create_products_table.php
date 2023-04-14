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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('address');
            $table->string('area');
            $table->string('city');
            $table->string('photo');
            $table->string('lat');
            $table->string('lng');
            $table->string('desc_code');
            $table->string('build_status');
            $table->string('sale_status');
            $table->string('road_segment');
            $table->string('max_distance');
            $table->string('speed_average');
            $table->boolean('city_center')->nullable();
            $table->boolean('airport')->nullable();
            $table->boolean('tourism')->nullable();
            $table->boolean('mall')->nullable();
            $table->boolean('hotel')->nullable();
            $table->boolean('restaurant')->nullable();
            $table->boolean('office_center')->nullable();
            $table->boolean('housing_area')->nullable();
            $table->string('username');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
