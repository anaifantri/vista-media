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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('media_category_id')->constrained();
            $table->foreignId('quotation_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->json('product');
            $table->double('price');
            $table->string('note');
            $table->string('duration')->nullable();
            $table->double('dpp')->nullable();
            $table->double('ppn')->nullable();
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->json('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
