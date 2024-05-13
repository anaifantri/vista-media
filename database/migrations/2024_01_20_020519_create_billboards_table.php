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
        Schema::create('billboards', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('billboard_category_id')->constrained();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('size_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('lighting');
            $table->string('orientation');
            $table->string('side');
            $table->string('condition');
            $table->string('sector');
            $table->string('road_segment');
            $table->string('max_distance');
            $table->string('speed_average');
            $table->decimal('price',12,0)->unsigned()->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billboards');
    }
};
