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
            $table->unsignedBigInteger('id_item_pembayaran')->after('date');
            $table->foreign('id_item_pembayaran')->references('id_item_pembayaran')->on('item_pembayaran')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['id_item_pembayaran']);
            $table->dropColumn('id_item_pembayaran');
        });
    }
};
