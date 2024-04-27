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
        Schema::create('industris', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('owner');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('telp');
            $table->string('email')->unique();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industris');
    }
};
