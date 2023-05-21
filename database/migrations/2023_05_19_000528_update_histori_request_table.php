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
        Schema::table('histori_request', function (Blueprint $table) {
            $table->string('attribute1');
            $table->string('attribute2');
            $table->json('items');
            $table->json('attributes');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('histori_request', function (Blueprint $table) {
            //
        });
    }
};
