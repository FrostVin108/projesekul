<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lab extends Model
{
    use HasFactory;

    protected $fillable = [
        'lab',
        'status',
        'lokasi',
        'kelas_id',
        'history',
        'guru_id_lab',
        'guru_id',
    ];
    // Relasi: Lab belongs to Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    // Relasi: Lab belongs to Guru (guru_id_lab)
    public function guruLab()
    {
        return $this->belongsTo(Guru::class, 'guru_id_lab');
    }
    // Relasi: Lab belongs to Guru (guru_id)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
    // Relasi inverse: Lab bisa memiliki banyak Ekstrakulikuler
    public function ekstrakulikulers()
    {
        return $this->hasMany(Ekstrakulikuler::class, 'lab_id');
    }
}
