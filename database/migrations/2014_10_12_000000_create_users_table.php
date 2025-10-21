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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Bisa di-sync dari tabel siswa atau guru
            $table->string('password'); // Di-sync dengan name dari tabel referensi (hash di controller)
            $table->enum('role', ['guru', 'siswa']); // Role untuk menentukan guru atau siswa
            $table->rememberToken();
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
