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
            $table->unsignedBigInteger('id_kategori_pembayaran')->after('id_pembayaran');
            $table->foreign('id_kategori_pembayaran')->references('id_kategori_pembayaran')->on('kategori_pembayaran')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['id_kategori_pembayaran']);
            $table->dropColumn('id_kategori_pembayaran');
        });
    }
};
