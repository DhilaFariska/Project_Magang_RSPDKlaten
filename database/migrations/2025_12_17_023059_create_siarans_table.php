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
        Schema::create('siarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->string('kategori');
            $table->text('deskripsi');
            $table->string('waktu_siaran');
            $table->string('presenter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siarans');
    }
};