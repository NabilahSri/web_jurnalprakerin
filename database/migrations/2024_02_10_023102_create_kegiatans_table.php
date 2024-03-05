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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi');
            $table->string('foto')->nullable();
            $table->string('durasi');
            $table->unsignedBigInteger('id_absensi');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_kelas');
            $table->foreign('id_absensi')->references('id')->on('absensis')->onDelete('no action')->onUpdate('no action');
            $table->foreign('id_siswa')->references('id')->on('siswas')->onDelete('no action')->onUpdate('no action');
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
