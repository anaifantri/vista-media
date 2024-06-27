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
        Schema::create('print_install_sales', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('contact_id')->constrained();
            $table->foreignId('billboard_id')->constrained();
            $table->foreignId('printing_product_id')->nullable()->constrained();
            $table->foreignId('installation_price_id')->nullable()->constrained();
            $table->foreignId('print_instal_quotation_id')->constrained();
            $table->decimal('print_price',12,0)->unsigned()->default(0)->nullable();
            $table->decimal('install_price',12,0)->unsigned()->default(0)->nullable();
            $table->json('terms_of_payment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_install_sales');
    }
};
