<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas_apa extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_berapa',
        'kelas_jurusan_id',
        'kelas_ke_berapa',
    ];
    // Relasi: KelasApa belongs to Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'kelas_jurusan_id');
    }
    // Relasi inverse: KelasApa bisa memiliki banyak Kelas
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'kelas_apa_id');
    }
}
