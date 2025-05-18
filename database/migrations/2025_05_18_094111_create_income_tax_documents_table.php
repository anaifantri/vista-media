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
        Schema::create('income_tax_documents', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('company');
            $table->foreignId('company_id')->constrained();
            $table->foreignId('payment_id')->constrained();
            $table->double('nominal');
            $table->json('images');
            $table->date('tax_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_tax_documents');
    }
};
