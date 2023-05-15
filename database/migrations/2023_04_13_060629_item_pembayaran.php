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
        Schema::create('item_pembayaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('description', 100);
            $table->integer('quantity');
            $table->double('itemPrice', 20);
            $table->double('amount', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pembayaran');
    }
};
