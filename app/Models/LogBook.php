<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    protected $table = 'logbook';
    protected $primaryKey = 'id_logbook';

    protected $fillable = [
        'nim',
        'id_program',
        'tanggal_mulai',
        'tanggal_selesai',
        'nama_kegiatan',
        'uraian_kegiatan',
        'jenis_logbook',
        'status_validasi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    public function programMagang()
    {
        return $this->belongsTo(ProgramMagang::class, 'id_program', 'id_program');
    }
}

