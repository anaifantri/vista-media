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
        Schema::create('land_agreements', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->json('first_party');
            $table->json('second_party');
            $table->string('notes')->nullable();
            $table->date('published');
            $table->string('duration');
            $table->date('start_at');
            $table->date('end_at');
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_agreements');
    }
};
