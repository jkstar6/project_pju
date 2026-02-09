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
        Schema::table('panel_kwh', function (Blueprint $table) {
            $table->string('kapanewon')->nullable()->after('lokasi_panel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panel_kwh', function (Blueprint $table) {
            $table->dropColumn('kapanewon');
        });
    }
};
