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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_mahasiswa');
            $table->string('nim_mahasiswa');
            $table->string('email_mahasiwa')->nullable();
            $table->string('phone_mahasiswa')->nullable();
            $table->string('address_mahasiswa')->nullable();
            $table->string('semester_mahasiswa', 15)->nullable();
            $table->string('tahun_akademik_mahasiswa')->nullable();
            $table->string('prodi_mahasiswa')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
