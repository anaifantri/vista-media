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
        Schema::create('videotron_quot_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videotron_quotation_id')->constrained();
            $table->string('number')->unique();
            $table->json('products');
            $table->json('notes');
            $table->json('modified_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videotron_quot_revisions');
    }
};