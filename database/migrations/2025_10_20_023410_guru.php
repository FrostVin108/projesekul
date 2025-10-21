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
            $table->string('name', 255);
            $table->string('email')->unique();
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('guru_bidang_id')->nullable(); // FK akan ditambahkan nanti
            $table->string('bio', 255)->nullable();
            $table->string('status', 255);
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
};
