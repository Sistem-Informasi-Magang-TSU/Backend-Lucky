<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BerkasMahasiswa extends Model
{
    protected $table = 'berkas_mahasiswa';

    protected $fillable = [
        'user_id',
        'cv_file',
        'transkrip_file',
        'krs_file',
        'is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isLengkap()
    {
        return $this->cv_file
            && $this->transkrip_file
            && $this->krs_file;
    }
}
