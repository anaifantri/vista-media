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
        Schema::create('print_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('vendor_id')->constrained();
            $table->foreignId('sale_id')->nullable()->constrained();
            $table->string('design');
            $table->string('theme');
            $table->date('print_at');
            $table->json('product');
            $table->json('notes');
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
        Schema::dropIfExists('print_orders');
    }
};
