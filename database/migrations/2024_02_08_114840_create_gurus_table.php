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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('telp')->nullable();
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
