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
            $table->string('amount')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->string('activeDate')->nullable()->change();
            $table->string('inactiveDate')->nullable()->change();
            $table->string('date')->nullable()->change();
            $table->string('prodi')->nullable()->change();
            $table->string('semester')->nullable()->change();
            $table->string('tahun_akademik')->nullable()->change();
            $table->string('nim')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
