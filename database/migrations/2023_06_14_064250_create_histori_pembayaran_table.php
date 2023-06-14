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
        Schema::create('histori_pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_pembayar');
            $table->string('amount');
            $table->date('tanggal_bayar');
            $table->String('va');
            $table->String('number');
            $table->string('method');
            $table->json('request_body')->nullable();
            $table->json('respons')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histori_pembayaran');
    }
};
