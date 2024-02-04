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
        Schema::create('signage_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signage_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signage_photos');
    }
};
