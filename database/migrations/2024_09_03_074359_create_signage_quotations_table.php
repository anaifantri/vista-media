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
        Schema::create('signage_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('signage_id')->constrained();
            $table->string('number')->unique();
            $table->string('attachment');
            $table->string('subject');
            $table->string('client_contact');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('body_top');
            $table->json('products');
            $table->json('notes');
            $table->json('payment_terms');
            $table->json('price');
            $table->string('body_end');
            $table->json('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signage_quotations');
    }
};
