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
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->string('letter_number')->unique();
            $table->string('invoice_number')->unique();
            $table->string('receipt_number')->unique();
            $table->json('term');
            $table->decimal('dpp',12,0)->unsigned()->default(0);
            $table->decimal('nominal',12,0)->unsigned()->default(0);
            $table->json('content');
            $table->json('approval');
            $table->json('order');
            $table->json('agreement');
            $table->json('created_by');
            $table->json('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billings');
    }
};
