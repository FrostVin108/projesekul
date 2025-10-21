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
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('lab', 255);
            $table->string('status', 255);
            $table->string('lokasi', 255);
            $table->unsignedBigInteger('kelas_id')->nullable(); // FK akan ditambahkan nanti
            $table->string('history', 255)->nullable();
            $table->unsignedBigInteger('guru_id_lab')->nullable(); // FK akan ditambahkan nanti
            $table->unsignedBigInteger('guru_id')->nullable(); // FK akan ditambahkan nanti
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('labs');
    }
};
