<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'pelajaran_id',
        'waktu',
    ];

    protected $casts = [
        'hari' => 'string', // Enum as string
        'waktu' => 'datetime:H:i', // Time format
    ];
    
    // Relasi: Jadwal belongs to Pelajaran
    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'pelajaran_id');
    }

}
