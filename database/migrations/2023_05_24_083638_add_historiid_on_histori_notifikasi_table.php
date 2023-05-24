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
        Schema::table('histori_notifikasi', function (Blueprint $table) {
            $table->uuid('histori_id')->after('id');
            $table->foreign('histori_id')->references('id')->on('histori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('histori_notifikasi', function (Blueprint $table) {
            $table->dropForeign(['histori_id']);
            $table->dropColumn('histori_id');
        });
    }
};


