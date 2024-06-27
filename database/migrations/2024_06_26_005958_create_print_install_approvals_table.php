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
        Schema::create('print_install_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('print_instal_quotation_id')->nullable()->constrained();
            $table->string('approval_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_install_approvals');
    }
};
