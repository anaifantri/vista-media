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
        Schema::table('license_documents', function (Blueprint $table) {
            $table->foreignId('licensing_category_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('license_documents', function (Blueprint $table) {
            $table->dropForeign(['licensing_category_id']);
            $table->dropColumn('licensing_category_id');
        });
    }
};
