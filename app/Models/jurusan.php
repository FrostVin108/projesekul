<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    // Relasi inverse: Jurusan memiliki banyak Siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'jurusan_id');
    }
    // Relasi inverse: Jurusan memiliki banyak KelasApa
    public function kelasApas()
    {
        return $this->hasMany(kelas_apa::class, 'kelas_jurusan_id');
    }
}
