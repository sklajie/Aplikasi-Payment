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
        Schema::table('pembayaran_lainnya', function (Blueprint $table) {
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('jenis_pembayaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran_lainnya', function (Blueprint $table) {
            //
        });
    }
};
