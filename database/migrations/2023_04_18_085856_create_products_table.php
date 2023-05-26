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
            $table->foreignId('area_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('size_id')->nullable()->constrained();
            $table->foreignId('led_id')->nullable()->constrained();
            $table->foreignId('vendor_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('code')->unique();
            $table->string('category');
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('sector')->nullable();
            $table->string('lighting')->nullable();
            $table->integer('qty');
            $table->string('property_status')->nullable();
            $table->string('build_status')->nullable();
            $table->string('sale_status')->nullable();
            $table->string('client')->nullable();
            $table->double('price')->nullable();
            $table->date('start_contract')->nullable();
            $table->date('end_contract')->nullable();
            $table->string('road_segment')->nullable();
            $table->string('max_distance')->nullable();
            $table->string('speed_average')->nullable();
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
