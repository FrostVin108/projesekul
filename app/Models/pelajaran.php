<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
    ];
    // Relasi inverse: Pelajaran bisa memiliki banyak Jadwal
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'pelajaran_id');
    }
}
