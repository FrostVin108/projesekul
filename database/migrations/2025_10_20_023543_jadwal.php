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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->enum('hari', ['senin', 'selasa', 'rabu', 'kamis', 'jumat']);
            $table->unsignedBigInteger('pelajaran_id')->nullable(); // FK akan ditambahkan nanti
            $table->time('waktu')->nullable();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
};
