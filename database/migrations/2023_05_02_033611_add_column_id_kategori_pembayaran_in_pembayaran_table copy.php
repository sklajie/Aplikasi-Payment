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
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->uuid('kategori_pembayaran_id')->after('id');
            $table->foreign('kategori_pembayaran_id')->references('id')->on('kategori_pembayaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['kategori_pembayaran_id']);
            $table->dropColumn('kategori_pembayaran_id');
        });
    }
};