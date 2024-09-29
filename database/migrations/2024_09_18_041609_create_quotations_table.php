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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('media_category_id')->constrained();
            $table->string('number')->unique();
            $table->string('attachment');
            $table->string('subject');
            $table->string('body_top');
            $table->string('body_end');
            $table->json('clients');
            $table->json('products');
            $table->json('notes');
            $table->json('payment_terms');
            $table->json('price');
            $table->json('created_by');
            $table->json('modified_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
