<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ruang_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('ruang', 255);
            $table->string('status', 255);
            $table->string('lokasi', 255);
            $table->unsignedBigInteger('kelas_id')->nullable(); // FK akan ditambahkan nanti
            $table->string('history', 255)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ruang_kelas');
    }
};
