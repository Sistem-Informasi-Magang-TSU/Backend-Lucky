<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMagang extends Model
{
    protected $table = 'program_magang';
    protected $primaryKey = 'id_program';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_program', 'nama_program', 'jenis_bkp',
        'id_mitra', 'periode', 'kuota', 'lokasi_penempatan',
        'syarat', 'deskripsi_silabus', 'dampak_program'
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra');
    }

    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'id_program');
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'id_program');
    }

    public function logbook()
    {
        return $this->hasMany(Logbook::class, 'id_program');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'id_program');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_program');
    }

    public function komponenNilai()
    {
        return $this->hasMany(KomponenNilai::class, 'id_program');
    }

    public function usulanKonversi()
    {
        return $this->hasMany(UsulanKonversi::class, 'id_program');
    }
}
