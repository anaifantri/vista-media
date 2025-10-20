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
        Schema::create('publish_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->nullable()->constrained();
            $table->foreignId('location_id')->constrained();
            $table->string('theme');
            $table->string('status');
            $table->date('publish_date');
            $table->string('notes')->nullable();
            $table->json('images');
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
        Schema::dropIfExists('publish_contents');
    }
};
