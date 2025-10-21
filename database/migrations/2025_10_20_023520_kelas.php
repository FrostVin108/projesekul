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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->integer('count_siswa');
            $table->unsignedBigInteger('ruang_id')->nullable(); // FK akan ditambahkan nanti
            // $table->unsignedBigInteger('absen')->nullable(); // FK akan ditambahkan nanti
            $table->unsignedBigInteger('siswa_id')->nullable(); // FK akan ditambahkan nanti
            $table->unsignedBigInteger('kelas_apa_id')->nullable(); // FK akan ditambahkan nanti
            // $table->unsignedBigInteger('piket')->nullable(); // FK akan ditambahkan nanti
            // $table->string('pkl', 5);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
};
