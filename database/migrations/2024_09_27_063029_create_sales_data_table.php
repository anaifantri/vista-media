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
        Schema::create('sales_data', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('media_category_id')->constrained();
            $table->foreignId('quotation_id')->constrained();
            $table->string('product_code');
            $table->string('note');
            $table->string('duration');
            $table->double('dpp')->nullable();
            $table->double('price');
            $table->double('ppn')->nullable();
            $table->double('pph')->nullable();
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
        Schema::dropIfExists('sales_data');
    }
};
