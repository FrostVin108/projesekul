<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakulikuler;
use App\Models\ruang_kelas;
use App\Models\Lab;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;

class EkstrakulikulerController extends Controller
{
    public function ekstra_index()
    {
        $ekstrakulikuler = Ekstrakulikuler::with(['ruangKelas', 'lab', 'siswa', 'guru'])->get();
        $ruang_kelas = ruang_kelas::all();
        $labs = Lab::all();
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('ekstrakulikuler', compact('ekstrakulikuler', 'ruang_kelas', 'labs', 'siswa', 'guru'));
    }

    public function ekstra_store(Request $request)
    {
        $request->validate([
            'ruang_id' => 'nullable|exists:ruang_kelas,id',
            'lab_id' => 'nullable|exists:labs,id',
            'status' => 'required|string|max:255',
            'siswa_id' => 'required|exists:siswas,id',
            'guru_id' => 'required|exists:gurus,id',
            'history' => 'nullable|string|max:255'
        ]);
        Ekstrakulikuler::create($request->only(['ruang_id', 'lab_id', 'status', 'siswa_id', 'guru_id', 'history']));
        return redirect()->route('ekstra');
    }

    public function ekstra_update(Request $request, Ekstrakulikuler $ekstrakulikuler)
    {
        $request->validate([
            'ruang_id' => 'nullable|exists:ruang_kelas,id',
            'lab_id' => 'nullable|exists:labs,id',
            'status' => 'required|string|max:255',
            'siswa_id' => 'required|exists:siswas,id',
            'guru_id' => 'required|exists:gurus,id',
            'history' => 'nullable|string|max:255'
        ]);
        $ekstrakulikuler->update($request->only(['ruang_id', 'lab_id', 'status', 'siswa_id', 'guru_id', 'history']));
        return redirect()->route('ekstra');
    }

    public function ekstra_destroy(Ekstrakulikuler $ekstrakulikuler)
    {
        $ekstrakulikuler->delete();
        return redirect()->route('ekstra');
    }
}