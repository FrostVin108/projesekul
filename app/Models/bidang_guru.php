<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bidang_guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    // Relasi inverse: Satu BidangGuru memiliki banyak Guru
    public function gurus()
    {
        return $this->hasMany(Guru::class, 'guru_bidang_id');
    }
}
