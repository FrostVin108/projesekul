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
        Schema::create('kelas_apas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas_berapa', 10);
            $table->unsignedBigInteger('kelas_jurusan_id')->nullable(); // FK akan ditambahkan nanti
            $table->integer('kelas_ke_berapa_id');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('kelas_apas');
    }
};
