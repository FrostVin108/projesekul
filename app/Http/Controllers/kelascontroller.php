<?php

namespace App\Http\Controllers;

use App\Models\ruang_kelas;
use App\Models\siswa;
use Illuminate\Http\Request;
use App\Models\kelas_apa;
use App\Models\jurusan;
use App\Models\kelas;

class kelascontroller extends Controller
{
    public function kelas_apa_index()
    {
        $kelas = kelas_apa::all();
        $jurusan = jurusan::all();
        return view('kelas.kelas_apa', compact('kelas', 'jurusan'));
    }

    public function kelas_apa_store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'kelas_berapa' => 'required',
            'kelas_jurusan_id' => 'required',
            'kelas_ke_berapa' => 'required'
        ]);
        kelas_apa::create($request->all());
        return redirect()->route('kelas.apa'); // Atau sesuaikan dengan route index Anda
    }

    public function kelas_apa_update(Request $request, kelas_apa $kelas_apa)
    {
        $request->validate([
            'kelas_berapa' => 'required',
            'kelas_jurusan_id' => 'required',
            'kelas_ke_berapa' => 'required'
        ]);
        $kelas_apa->update($request->only(['kelas_berapa', 'kelas_jurusan_id', 'kelas_ke_berapa']));
        return redirect()->route('kelas.apa'); // Atau sesuaikan
    }

    public function kelas_apa_destroy(kelas_apa $kelas_apa)
    {
        $kelas_apa->delete();
        return redirect()->route('kelas.apa'); // Atau sesuaikan
    }






    public function kelas_index()
    {
        $kelas = kelas::with(['ruangKelas', 'kelasApa'])->get();
        $ruang_kelas = ruang_kelas::all();
        $kelas_apas = kelas_apa::all();
        return view('kelas.kelas', compact('kelas', 'ruang_kelas', 'kelas_apas'));
    }
    public function kelas_store(Request $request)
    {
        $request->validate([
            'count_siswa' => 'integer|min:0',
            'ruang_id' => 'nullable|exists:ruang_kelas,id',
            'kelas_apa_id' => 'nullable|exists:kelas_apas,id',
        ]);
        kelas::create([
            'count_siswa' => $request->count_siswa,
            'ruang_id' => $request->ruang_id,
            'kelas_apa_id' => $request->kelas_apa_id,
        ]);
        return redirect()->route('kelas');
    }

    public function kelas_update(Request $request, kelas $kelas)
    {
        $request->validate([
            'count_siswa' => 'required|integer|min:0',
            'ruang_id' => 'nullable|exists:ruang_kelas,id',
            'kelas_apa_id' => 'nullable|exists:kelas_apas,id',
        ]);
        $kelas->update([
            'count_siswa' => $request->count_siswa,
            'ruang_id' => $request->ruang_id,
            'kelas_apa_id' => $request->kelas_apa_id,
        ]);
        return redirect()->route('kelas');
    }
    public function kelas_destroy(kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas');
    }
}
