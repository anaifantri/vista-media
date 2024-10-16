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
            $table->foreignId('location_id')->constrained();
            $table->string('design');
            $table->string('theme');
            $table->string('notes')->nullable();
            $table->decimal('price',12,0)->unsigned()->default(0);
            $table->json('product');
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
