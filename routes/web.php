<?php

use App\Http\Controllers\pelajarancontroller;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\usercontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gurucontroller;
use App\Http\Controllers\siswacontroller;
use App\Http\Controllers\kelascontroller;
use App\Http\Controllers\ekstrakulikulercontroller;
use App\Http\Controllers\registercontroller;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('pelajaran');
// });

// Routes untuk register
Route::get('/register', [usercontroller::class, 'showRegisterForm'])->name('register');
Route::post('/register', [usercontroller::class, 'register']);
// Routes untuk login
Route::get('/login', [usercontroller::class, 'showLoginForm'])->name('login');
Route::post('/login', [usercontroller::class, 'login']);
// Route untuk logout (opsional, bisa ditambahkan di middleware auth)
Route::post('/logout', [usercontroller::class, 'logout'])->name('logout');

Route::middleware(['auth', 'cekRoleGuru'])->group(function () {

    Route::get('/guru/bidang', [gurucontroller::class, 'index'])->name('guru.bidang');
    Route::post('/guru/bidang', [gurucontroller::class, 'store'])->name('guru.bidang.store');
    Route::put('/guru/bidang/{bidangGuru}', [gurucontroller::class, 'update'])->name('guru.bidang.update');
    Route::delete('/guru/bidang/{bidangGuru}', [gurucontroller::class, 'destroy'])->name('guru.bidang.destroy');

    Route::get('/guru', [gurucontroller::class, 'guru_index'])->name('guru');
    Route::post('/guru', [gurucontroller::class, 'guru_store'])->name('guru.store');
    Route::put('/guru/{guru}', [gurucontroller::class, 'guru_update'])->name('guru.update');
    Route::delete('/guru/{guru}', [gurucontroller::class, 'guru_destroy'])->name('guru.destroy');

    Route::get('/jurusan', [siswacontroller::class, 'jurusan_index'])->name('siswa.jurusan');
    Route::post('/jurusan', [siswacontroller::class, 'jurusan_store'])->name('siswa.jurusan.store');
    Route::put('/jurusan/{jurusan}', [siswacontroller::class, 'jurusan_update'])->name('siswa.jurusan.update');
    Route::delete('/jurusan/{jurusan}', [siswacontroller::class, 'jurusan_destroy'])->name('siswa.jurusan.destroy');

    Route::get('/siswa', [siswacontroller::class, 'siswa_index'])->name('siswa');
    Route::post('/siswa', [siswacontroller::class, 'siswa_store'])->name('siswa.store');
    Route::put('/siswa/{siswa}', [siswacontroller::class, 'siswa_update'])->name('siswa.update');
    Route::delete('/siswa/{siswa}', [siswacontroller::class, 'siswa_destroy'])->name('siswa.destroy');

    Route::get('/kelas/apa', [kelascontroller::class, 'kelas_apa_index'])->name('kelas.apa');
    Route::post('/kelas/apa', [kelascontroller::class, 'kelas_apa_store'])->name('kelas.apa.store');
    Route::put('/kelas/apa/{kelas_apa}', [kelascontroller::class, 'kelas_apa_update'])->name('kelas.apa.update');
    Route::delete('/kelas/apa/{kelas_apa}', [kelascontroller::class, 'kelas_apa_destroy'])->name('kelas.apa.destroy');

    Route::get('/kelas', [kelascontroller::class, 'kelas_index'])->name('kelas');
    Route::post('/kelas', [kelascontroller::class, 'kelas_store'])->name('kelas.store');
    Route::put('/kelas{kelas}', [kelascontroller::class, 'kelas_update'])->name('kelas.update');
    Route::delete('/kelas{kelas}', [kelascontroller::class, 'kelas_destroy'])->name('kelas.destroy');

    Route::get('/ekstrakulikuler', [ekstrakulikulercontroller::class, 'ekstra_index'])->name('ekstra');
    Route::post('/ekstrakulikuler', [ekstrakulikulercontroller::class, 'ekstra_store'])->name('ekstra.store');
    Route::put('/ekstrakulikuler/{ekstrakulikuler}', [ekstrakulikulercontroller::class, 'ekstra_update'])->name('ekstra.update');
    Route::delete('/ekstrakulikuler/{ekstrakulikuler}', [ekstrakulikulercontroller::class, 'ekstra_destroy'])->name('ekstra.destroy');

    Route::get('/pelajaran', [pelajarancontroller::class, 'pelajaran_index'])->name(name: 'pelajaran');
    Route::post('/pelajaran', [pelajarancontroller::class, 'pelajaran_store'])->name('pelajaran.store');
    Route::put('/pelajaran/{pelajaran}', [pelajarancontroller::class, 'pelajaran_update'])->name('pelajaran.update');
    Route::delete('/pelajaran/{pelajaran}', [pelajarancontroller::class, 'pelajaran_destroy'])->name('pelajaran.destroy');

    Route::get('/jadwal', [pelajarancontroller::class, 'jadwal_index'])->name(name: 'jadwal');
    Route::post('/jadwal', [pelajarancontroller::class, 'jadwal_store'])->name('jadwal.store');
    Route::put('/jadwal/{jadwal}', [pelajarancontroller::class, 'jadwal_update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [pelajarancontroller::class, 'jadwal_destroy'])->name('jadwal.destroy');

    Route::get('/jadwal', [pelajarancontroller::class, 'jadwal_index'])->name(name: 'jadwal');
    Route::post('/jadwal', [pelajarancontroller::class, 'jadwal_store'])->name('jadwal.store');
    Route::put('/jadwal/{jadwal}', [pelajarancontroller::class, 'jadwal_update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [pelajarancontroller::class, 'jadwal_destroy'])->name('jadwal.destroy');

    Route::get('/lab', [RuanganController::class, 'lab_index'])->name(name: 'lab');
    Route::post('/lab', [RuanganController::class, 'lab_store'])->name('lab.store');
    Route::put('/lab/{lab}', [RuanganController::class, 'lab_update'])->name('lab.update');
    Route::delete('/lab/{lab}', [RuanganController::class, 'lab_destroy'])->name('lab.destroy');

    Route::get('/ruang-kelas', [RuanganController::class, 'ruang_index'])->name('ruang_kelas');
    Route::post('/ruang-kelas', [RuanganController::class, 'ruang_store'])->name('ruang_kelas.store');
    Route::put('/ruang-kelas/{ruang_kelas}', [RuanganController::class, 'ruang_update'])->name('ruang_kelas.update');
    Route::delete('/ruang-kelas/{ruang_kelas}', [RuanganController::class, 'ruang_destroy'])->name('ruang_kelas.destroy');
});

Route::get('/shutdown', function () {
    exec('shutdown /s /t 5'); // Shutdown dalam 5 detik untuk memberi waktu merespon
    return 'Shutdown akan berlangsung dalam 5 detik!';
})->name('shutdown');