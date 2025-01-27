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
        Schema::create('takedown_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('install_order_id')->nullable()->constrained();
            $table->foreignId('location_id')->constrained();
            $table->string('design')->nullable();
            $table->string('theme');
            $table->date('takedown_at');
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('takedown_orders');
    }
};
