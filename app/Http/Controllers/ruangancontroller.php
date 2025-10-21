<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\ruang_kelas;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    // CRUD untuk Lab
    public function lab_index()
    {
        $labs = Lab::with(['kelas', 'guruLab', 'guru'])->get(); // Load relasi
        $kelas = Kelas::all(); // Untuk dropdown kelas
        $gurus = Guru::all(); // Untuk dropdown guru
        return view('ruangan.lab', compact('labs', 'kelas', 'gurus'));
    }

    public function lab_store(Request $request)
    {
        $request->validate([
            'lab' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:kelas,id',
            'guru_id_lab' => 'nullable|exists:gurus,id',
            'guru_id' => 'nullable|exists:gurus,id',
            'history' => 'nullable|string|max:255',
        ]);
        Lab::create($request->only(['lab', 'status', 'lokasi', 'kelas_id', 'guru_id_lab', 'guru_id', 'history']));
        return redirect()->route('lab'); // Sesuaikan dengan route yang Anda buat
    }

    public function lab_update(Request $request, Lab $lab)
    {
        $request->validate([
            'lab' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:kelas,id',
            'guru_id_lab' => 'nullable|exists:gurus,id',
            'guru_id' => 'nullable|exists:gurus,id',
            'history' => 'nullable|string|max:255',
        ]);
        $lab->update($request->only(['lab', 'status', 'lokasi', 'kelas_id', 'guru_id_lab', 'guru_id', 'history']));
        return redirect()->route('lab');
    }

    public function lab_destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()->route('lab');
    }

    // CRUD untuk Ruang Kelas
    public function ruang_index()
    {
        $ruang_kelas = ruang_kelas::with('kelas')->get(); // Load relasi
        $kelas = Kelas::all(); // Untuk dropdown kelas
        return view('ruangan.ruang_kelas', compact('ruang_kelas', 'kelas'));
    }

    public function ruang_store(Request $request)
    {
        $request->validate([
            'ruang' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:kelas,id',
            'history' => 'nullable|string|max:255',
        ]);
        ruang_kelas::create($request->only(['ruang', 'status', 'lokasi', 'kelas_id', 'history']));
        return redirect()->route('ruang_kelas'); // Sesuaikan dengan route yang Anda buat
    }

    public function ruang_update(Request $request, ruang_kelas $ruang_kelas)
    {
        $request->validate([
            'ruang' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'kelas_id' => 'nullable|exists:kelas,id',
            'history' => 'nullable|string|max:255',
        ]);
        $ruang_kelas->update($request->only(['ruang', 'status', 'lokasi', 'kelas_id', 'history']));
        return redirect()->route('ruang_kelas');
    }

    public function ruang_destroy(ruang_kelas $ruang_kelas)
    {
        $ruang_kelas->delete();
        return redirect()->route('ruang_kelas');
    }
}