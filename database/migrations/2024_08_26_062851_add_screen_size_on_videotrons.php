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
        Schema::table('videotrons', function (Blueprint $table) {
            $table->integer('screen_w');
            $table->integer('screen_h');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videotrons', function (Blueprint $table) {
            $table->dropColumn('screen_w');
            $table->dropColumn('screen_h');
        });
    }
};
