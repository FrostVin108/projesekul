<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // CRUD untuk Jurusan
    public function jurusan_index()
    {
        $jurusans = Jurusan::all();
        return view('siswa.jurusan', compact('jurusans'));
    }

    public function jurusan_store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        Jurusan::create($request->only('name'));
        return redirect()->route('siswa.jurusan');
    }

    public function jurusan_update(Request $request, Jurusan $jurusan)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $jurusan->update($request->only('name'));
        return redirect()->route('siswa.jurusan');
    }

    public function jurusan_destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('siswa.jurusan');
    }

    // CRUD untuk Siswa
    public function siswa_index()
    {
        $siswas = Siswa::with(['jurusan', 'kelas', 'ekstrakulikulers'])->get(); // Load relasi termasuk ekstrakulikulers
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        return view('siswa.siswa', compact('siswas', 'jurusans', 'kelas'));
    }

    public function siswa_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email',
            'tanggal_lahir' => 'required|date',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);
        Siswa::create($request->only(['name', 'email', 'tanggal_lahir', 'jurusan_id', 'kelas_id']));
        return redirect()->route('siswa');
    }

    public function siswa_update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email,' . $siswa->id,
            'tanggal_lahir' => 'required|date',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);
        $siswa->update($request->only(['name', 'email', 'tanggal_lahir', 'jurusan_id', 'kelas_id']));
        return redirect()->route('siswa');
    }

    public function siswa_destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa');
    }
}