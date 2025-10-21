<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekstrakulikuler extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruang_id',
        'lab_id',
        'status',
        'siswa_id',
        'guru_id',
        'history',
    ];
    // Relasi: Ekstrakulikuler belongs to RuangKelas
    public function ruangKelas()
    {
        return $this->belongsTo(ruang_kelas::class, 'ruang_id');
    }
    // Relasi: Ekstrakulikuler belongs to Lab
    public function lab()
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }
    // Relasi: Ekstrakulikuler belongs to Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    // Relasi: Ekstrakulikuler belongs to Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
