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
        Schema::create('w_o_prints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('print_install_sale_id')->nullable()->constrained();
            $table->foreignId('sale_id')->constrained();
            $table->foreignId('vendor_id')->constrained();
            $table->integer('wide');
            $table->string('status');
            $table->decimal('price',12,0)->unsigned()->default(0);
            $table->string('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('w_o_prints');
    }
};
