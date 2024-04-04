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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('contact_id')->constrained();
            $table->foreignId('billboard_id')->constrained();
            $table->foreignId('billboard_quotation_id')->nullable()->constrained();
            $table->foreignId('billboard_quot_revision_id')->nullable()->constrained();
            $table->decimal('price',12,0)->unsigned()->default(0);
            $table->decimal('dpp',12,0)->unsigned()->default(0);
            $table->string('category');
            $table->string('duration');
            $table->date('start_at')->nullable();
            $table->date('end_at')->nullable();
            $table->json('terms_of_payment');
            $table->integer('free_instalation');
            $table->integer('free_print');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
