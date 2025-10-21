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
        Schema::create('ekstrakulikulers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ruang_id')->nullable(); // FK akan ditambahkan nanti
            $table->unsignedBigInteger('lab_id')->nullable(); // FK akan ditambahkan nanti
            $table->string('status', 255);
            $table->unsignedBigInteger('siswa_id')->nullable(); // FK akan ditambahkan nanti
            $table->unsignedBigInteger('guru_id')->nullable();
            $table->string('history', 255)->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('ekstrakulikulers');
    }
};
