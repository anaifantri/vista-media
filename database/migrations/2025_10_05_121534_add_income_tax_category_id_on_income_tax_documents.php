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
        Schema::table('income_tax_documents', function (Blueprint $table) {
            $table->foreignId('income_tax_category_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('income_tax_documents', function (Blueprint $table) {
            $table->dropForeign(['income_tax_category_id']);
            $table->dropColumn('income_tax_category_id');
        });
    }
};
