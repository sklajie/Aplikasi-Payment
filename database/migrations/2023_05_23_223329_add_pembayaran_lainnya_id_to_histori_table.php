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
        Schema::table('histori', function (Blueprint $table) {
            $table->uuid('pembayaran_lainnya_id')->after('id');
            $table->foreign('pembayaran_lainnya_id')->references('id')->on('pembayaran_lainnya')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('histori', function (Blueprint $table) {
            $table->dropForeign(['pembayaran_lainnya_id']);
            $table->dropColumn('pembayaran_lainnya_id');
        });
    }
};
