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
        Schema::create('change_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->double('price');
            $table->double('price_diff');
            $table->double('ppn_diff');
            $table->json('quotation_price');
            $table->string('note');
            $table->string('duration')->nullable();
            $table->double('dpp')->nullable();
            $table->double('ppn')->nullable();
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->json('images')->nullable();
            $table->json('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_sales');
    }
};
