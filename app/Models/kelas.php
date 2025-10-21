<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'count_siswa',
        'ruang_id',
        // 'siswa_id',
        'kelas_apa_id',
    ];
    // Relasi: Kelas belongs to RuangKelas
    public function ruangKelas()
    {
        return $this->belongsTo(ruang_kelas::class, 'ruang_id');
    }
    // Relasi: Kelas belongs to Siswa
    // public function siswa()
    // {
    //     return $this->belongsTo(Siswa::class, 'siswa_id');
    // }
    // Relasi: Kelas belongs to KelasApa
    public function kelasApa()
    {
        return $this->belongsTo(kelas_apa::class, 'kelas_apa_id');
    }
    // Relasi inverse: Kelas bisa memiliki banyak Siswa (kelas_id di siswas)
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }
    // Relasi inverse: Kelas bisa memiliki RuangKelas
    public function ruangKelasInverse()
    {
        return $this->hasOne(ruang_kelas::class, 'kelas_id');
    }
    // Relasi inverse: Kelas bisa memiliki banyak Lab
    public function labs()
    {
        return $this->hasMany(Lab::class, 'kelas_id');
    }
}
