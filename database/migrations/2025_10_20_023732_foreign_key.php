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
        // FK untuk guru
        Schema::table('gurus', function (Blueprint $table) {
            $table->foreign('guru_bidang_id')->references('id')->on('bidang_gurus')->onDelete('cascade');
        });

        // FK untuk siswa
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
            // $table->foreign('absensi')->references('id')->on('absensis')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
        // FK untuk kelas
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('ruang_id')->references('id')->on('ruang_kelas')->onDelete('cascade');
            // $table->foreign('absen')->references('id')->on('absensis')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('kelas_apa_id')->references('id')->on('kelas_apas')->onDelete('cascade');
            // $table->foreign('piket')->references('id')->on('pikets')->onDelete('cascade');
        });
        // FK untuk kelas_apa
        Schema::table('kelas_apas', function (Blueprint $table) {
            $table->foreign('kelas_jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');
        });

        // FK untuk jadwal
        Schema::table('jadwals', function (Blueprint $table) {
            $table->foreign('pelajaran_id')->references('id')->on('pelajarans')->onDelete('cascade');
        });

        // FK untuk ruang_kelas
        Schema::table('ruang_kelas', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
        // FK untuk lab
        Schema::table('labs', function (Blueprint $table) {
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('guru_id_lab')->references('id')->on('gurus')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });
        // FK untuk ekstrakulikuler
        Schema::table('ekstrakulikulers', function (Blueprint $table) {
            $table->foreign('ruang_id')->references('id')->on('ruang_kelas')->onDelete('cascade');
            $table->foreign('lab_id')->references('id')->on('labs')->onDelete('cascade');
            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('gurus')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
