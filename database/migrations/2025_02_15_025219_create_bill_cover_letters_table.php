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
        Schema::create('bill_cover_letters', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('company_id')->constrained();
            $table->string('billing_id');
            $table->string('work_report_id');
            $table->string('vat_tax_invoice_id');
            $table->string('quotation_approval_id')->nullable();
            $table->string('quotation_order_id')->nullable();
            $table->string('quotation_agreement_id')->nullable();
            $table->json('content');
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
        Schema::dropIfExists('bill_cover_letters');
    }
};
