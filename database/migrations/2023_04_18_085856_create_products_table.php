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
            $table->foreignId('size_id')->constrained();
            $table->foreignId('product_category_id')->constrained();
            $table->foreignId('led_id')->nullable()->constrained();
            $table->foreignId('vendor_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('code')->unique();
            $table->string('address');
            $table->string('photo');
            $table->string('lat');
            $table->string('lng');
            $table->string('sector');
            $table->string('lighting');
            $table->integer('qty');
            $table->string('property_status');
            $table->string('build_status');
            $table->string('sale_status');
            $table->string('road_segment');
            $table->string('max_distance');
            $table->string('speed_average');
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
