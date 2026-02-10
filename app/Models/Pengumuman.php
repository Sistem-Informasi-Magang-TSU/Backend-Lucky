<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'isi',
        'jenis_pengumuman',
        'dibuat_oleh',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
