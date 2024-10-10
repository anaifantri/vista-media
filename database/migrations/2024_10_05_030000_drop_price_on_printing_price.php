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
        Schema::table('printing_prices', function (Blueprint $table) {
            $table->dropColumn('sale_price');
            $table->dropColumn('print_price');
            $table->decimal('price',12,0)->unsigned()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('printing_prices', function (Blueprint $table) {
            $table->dropColumn('price');
            $table->decimal('sale_price',12,0)->unsigned()->default(0);
            $table->decimal('print_price',12,0)->unsigned()->default(0);
        });
    }
};
