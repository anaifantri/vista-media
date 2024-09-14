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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('media_category_id')->constrained();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('city_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('media_size_id')->constrained();
            $table->string('side');
            $table->string('orientation');
            $table->string('address');
            $table->string('condition');
            $table->string('road_segment');
            $table->string('max_distance');
            $table->string('speed_average');
            $table->json('description');
            $table->json('created_by');
            $table->json('modified_by');
            $table->json('sector');
            $table->decimal('price',12,0)->unsigned()->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
