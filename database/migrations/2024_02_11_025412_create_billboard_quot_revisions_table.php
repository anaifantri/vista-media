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
        Schema::create('billboard_quot_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('billboard_quotation_id')->constrained();
            $table->string('number')->unique();
            $table->string('attachment');
            $table->string('subject');
            $table->string('body_top');
            $table->json('billboards');
            $table->json('note');
            $table->string('body_end');
            $table->string('price_type');
            $table->date('send_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billboard_quot_revisions');
    }
};
