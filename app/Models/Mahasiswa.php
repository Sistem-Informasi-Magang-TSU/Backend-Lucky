<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'nim',
        'prodi',
        'angkatan',
        'status',
        'nomor_telepon',
        'posisi',
        'riwayat_magang',
        'foto',
    ];

    // RELASI
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'nim', 'nim');
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'nim', 'nim');
    }

    public function logbook()
    {
        return $this->hasMany(Logbook::class, 'nim', 'nim');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'nim', 'nim');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'nim', 'nim');
    }

    public function transkripMagang()
    {
        return $this->hasMany(TranskripMagang::class, 'nim', 'nim');
    }

    // relasi tabel user untuk pengambilan nim
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


