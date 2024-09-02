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
        Schema::create('videotron_quotation_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videotron_quotation_id')->nullable()->constrained();
            $table->foreignId('videotron_quot_revision_id')->nullable()->constrained();
            $table->string('name');
            $table->string('number')->nullable();
            $table->date('order_date');
            $table->string('order_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videotron_quotation_orders');
    }
};
