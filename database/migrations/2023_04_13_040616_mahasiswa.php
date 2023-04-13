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
            $table->id_mahasiswa();
            $table->string('nama', 50);
            $table->number('nim', 15)->unque();
            $table->string('kelas', 10);
            $table->string('email', 50)->unique();
            $table->number('no_hp', 15);
            $table->string('prodi', 40);
            $table->string('alamat');
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
