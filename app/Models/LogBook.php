<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogBook extends Model
{
    protected $table = 'logbook';
    protected $primaryKey = 'id_logbook';

    protected $fillable = [
        'nim', 'id_program', 'tanggal', 'aktivitas',
        'lampiran', 'jenis_logbook', 'status_validasi'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim');
    }

    public function programMagang()
    {
        return $this->belongsTo(ProgramMagang::class, 'id_program');
    }
}
