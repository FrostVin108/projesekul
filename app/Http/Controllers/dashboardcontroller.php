<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Jadwal;
use App\Models\Ekstrakulikuler;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data penting untuk dashboard
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalKelas = Kelas::count();
        $totalJadwal = Jadwal::count();
        $totalEkstrakulikuler = Ekstrakulikuler::count();

        // Data terbaru atau contoh (misal 5 terbaru)
        $recentSiswa = Siswa::latest()->take(5)->get();
        $recentGuru = Guru::latest()->take(5)->get();
        $recentKelas = Kelas::with(['ruangKelas', 'kelasApa'])->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalSiswa',
            'totalGuru',
            'totalKelas',
            'totalJadwal',
            'totalEkstrakulikuler',
            'recentSiswa',
            'recentGuru',
            'recentKelas'
        ));
    }
}