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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email')->unique();
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('jurusan_id')->nullable(); // FK akan ditambahkan nanti
            $table->unsignedBigInteger('kelas_id')->nullable(); // FK akan ditambahkan nanti
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
