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
        Schema::create('billboard_quot_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('billboard_quotation_id')->nullable()->constrained();
            $table->foreignId('billboard_quot_revision_id')->nullable()->constrained();
            $table->string('status');
            $table->string('description');
            $table->string('status_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billboard_quot_statuses');
    }
};
