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
        Schema::create('signage_quot_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('signage_quotation_id')->nullable()->constrained();
            $table->foreignId('signage_quot_revision_id')->nullable()->constrained();
            $table->string('status');
            $table->string('description');
            $table->string('status_image')->nullable();
            $table->json('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signage_quot_statuses');
    }
};