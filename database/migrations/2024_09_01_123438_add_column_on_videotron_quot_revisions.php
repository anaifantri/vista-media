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
        Schema::table('videotron_quot_revisions', function (Blueprint $table) {
            $table->json('payment_terms');
            $table->json('price');
            $table->dropColumn('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videotron_quot_revisions', function (Blueprint $table) {
            $table->json('products');
            $table->dropColumn('price');
            $table->dropColumn('payment_terms');
        });
    }
};
