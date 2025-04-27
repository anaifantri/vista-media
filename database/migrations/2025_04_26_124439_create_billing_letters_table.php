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
        Schema::create('billing_letters', function (Blueprint $table) {
            $table->unsignedBigInteger('billing_id');
            $table->unsignedBigInteger('bill_cover_letter_id');
            $table->foreign('billing_id')->references('id')->on('billings')->onDelete('cascade');
            $table->foreign('bill_cover_letter_id')->references('id')->on('bill_cover_letters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_letters');
    }
};
