<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruang_kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'ruang',
        'status',
        'lokasi',
        'kelas_id',
        'history',
    ];
    // Relasi: RuangKelas belongs to Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    // Relasi inverse: RuangKelas bisa memiliki banyak Kelas
    public function kelasInverse()
    {
        return $this->hasMany(Kelas::class, 'ruang_id');
    }
    // Relasi inverse: RuangKelas bisa memiliki banyak Ekstrakulikuler
    public function ekstrakulikulers()
    {
        return $this->hasMany(Ekstrakulikuler::class, 'ruang_id');
    }
}
