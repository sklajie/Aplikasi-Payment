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
            $table->uuid('attribute_pembayaran_id')->after('date');
            $table->foreign('attribute_pembayaran_id')->references('id')->on('attribute_pembayaran')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['attribute_pembayaran_id']);
            $table->dropColumn('attribute_pembayaran_id');
        });
    }
};
