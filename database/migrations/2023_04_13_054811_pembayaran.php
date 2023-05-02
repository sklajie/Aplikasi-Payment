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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id_pembayaran();
            $table->string('semester', 15);
            $table->string('amount', 10);
            $table->string('va', 15);
            $table->boolean('openPayment');
            $table->date('activeDate');
            $table->date('inactiveDate');
            $table->date('Date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
