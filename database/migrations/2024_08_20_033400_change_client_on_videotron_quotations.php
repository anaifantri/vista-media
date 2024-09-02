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
        Schema::table('videotron_quotations', function (Blueprint $table) {
            $table->foreignId('client_id')->constrained();
            $table->foreignId('videotron_id')->constrained();
            $table->json('payment_terms');
            $table->json('price');
            $table->dropColumn('client_company');
            $table->dropColumn('client_name');          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videotron_quotations', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropColumn('client_id');
            $table->dropForeign(['videotron_id']);
            $table->dropColumn('videotron_id');
            $table->dropColumn('payment_terms');
            $table->dropColumn('price');
            $table->string('client_company');
            $table->string('client_name');
        });
    }
};
