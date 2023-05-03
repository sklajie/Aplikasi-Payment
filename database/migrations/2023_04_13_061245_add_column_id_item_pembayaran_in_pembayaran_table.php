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
            $table->uuid('item_pembayaran_id')->primary()->after('date');
            $table->foreign('item_pembayaran_id')->references('id')->on('item_pembayaran')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['item_pembayaran_id']);
            $table->dropColumn('item_pembayaran_id');
        });
    }
};
