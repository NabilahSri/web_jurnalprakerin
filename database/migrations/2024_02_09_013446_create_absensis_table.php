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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->time('jam_masuk')->nullable();
            $table->time('jam_pulang')->nullable();
            $table->enum('status',['hadir','sakit','alfa','izin']);
            $table->string('catatan')->nullable();
            $table->string('bukti')->nullable();
            $table->string('alamat')->nullable();
            $table->unsignedBigInteger('id_siswa');
            $table->timestamps();
            $table->foreign('id_siswa')->references('id')->on('siswas')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
