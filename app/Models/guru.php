<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tanggal_lahir',
        'guru_bidang_id',
        'bio',
        'status',
    ];
    // Relasi: Guru belongs to BidangGuru
    public function bidangGuru()
    {
        return $this->belongsTo(bidang_guru::class, 'guru_bidang_id');
    }
    // Relasi inverse: Guru bisa memiliki banyak Lab (guru_id_lab dan guru_id)
    public function labs()
    {
        return $this->hasMany(Lab::class, 'guru_id_lab');
    }
    public function labsAsGuru()
    {
        return $this->hasMany(Lab::class, 'guru_id');
    }
    // Relasi inverse: Guru bisa memiliki banyak Ekstrakulikuler
    public function ekstrakulikulers()
    {
        return $this->hasMany(Ekstrakulikuler::class, 'guru_id');
    }
    // Relasi inverse: Guru bisa memiliki User
    public function user()
    {
        return $this->hasOne(User::class, 'guru_id');
    }
}
