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
        $kelas = kelas::with(['ruangKelas', 'siswa', 'kelasApa', 'siswas'])->get(); // Tambah 'siswas' untuk load siswa terkait
        $ruang_kelas = ruang_kelas::all();
        $siswas = Siswa::all();
        $kelas_apas = kelas_apa::all();
        return view('kelas.kelas', compact('kelas', 'ruang_kelas', 'siswas', 'kelas_apas'));
    }
    public function kelas_store(Request $request)
    {
        $request->validate([
            'count_siswa' => 'required|integer|min:0', // Akan dihitung otomatis, tapi tetap validasi
            'ruang_id' => 'nullable|exists:ruang_kelas,id',
            'siswa_id' => 'nullable|array', // Sekarang array
            'siswa_id.*' => 'exists:siswas,id', // Validasi setiap item di array
            'kelas_apa_id' => 'nullable|exists:kelas_apas,id',
        ]);
        // Hitung count_siswa dari jumlah siswa yang dipilih
        $countSiswa = count($request->siswa_id ?? []);
        $kelas = kelas::create([
            'count_siswa' => $countSiswa,
            'ruang_id' => $request->ruang_id,
            'siswa_id' => $request->siswa_id ? $request->siswa_id[0] : null, // Simpan siswa pertama sebagai siswa_id utama (belongsTo)
            'kelas_apa_id' => $request->kelas_apa_id,
        ]);
        // Attach siswa ke kelas (update kelas_id pada siswa)
        if ($request->siswa_id) {
            Siswa::whereIn('id', $request->siswa_id)->update(['kelas_id' => $kelas->id]);
        }
        return redirect()->route('kelas'); // Sesuaikan dengan route yang Anda buat
    }
    public function kelas_update(Request $request, kelas $kelas)
    {
        $request->validate([
            'count_siswa' => 'required|integer|min:0',
            'ruang_id' => 'nullable|exists:ruang_kelas,id',
            'siswa_id' => 'nullable|array',
            'siswa_id.*' => 'exists:siswas,id',
            'kelas_apa_id' => 'nullable|exists:kelas_apas,id',
        ]);
        // Hitung count_siswa dari jumlah siswa yang dipilih
        $countSiswa = count($request->siswa_id ?? []);
        $kelas->update([
            'count_siswa' => $countSiswa,
            'ruang_id' => $request->ruang_id,
            'siswa_id' => $request->siswa_id ? $request->siswa_id[0] : null,
            'kelas_apa_id' => $request->kelas_apa_id,
        ]);
        // Detach siswa lama, attach yang baru
        Siswa::where('kelas_id', $kelas->id)->update(['kelas_id' => null]); // Reset kelas_id siswa lama
        if ($request->siswa_id) {
            Siswa::whereIn('id', $request->siswa_id)->update(['kelas_id' => $kelas->id]);
        }

        return redirect()->route('kelas');
    }

    public function kelas_destroy(kelas $kelas)
    {
        Siswa::where('kelas_id', $kelas->id)->update(['kelas_id' => null]);
        $kelas->delete();
        return redirect()->route('kelas');
    }
}
