<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tanggal_lahir',
        'jurusan_id',
        'kelas_id',
    ];
    // Relasi: Siswa belongs to Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
    // Relasi: Siswa belongs to Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    // Relasi inverse: Siswa bisa memiliki Kelas (siswa_id di kelas)
    // public function kelasAsSiswa()
    // {
    //     return $this->hasOne(Kelas::class, 'siswa_id');
    // }
    // Relasi inverse: Siswa bisa memiliki banyak Ekstrakulikuler
    public function ekstrakulikulers()
    {
        return $this->hasMany(Ekstrakulikuler::class, 'siswa_id');
    }
    // Relasi inverse: Siswa bisa memiliki User
    public function user()
    {
        return $this->hasOne(User::class, 'siswa_id');
    }
}
