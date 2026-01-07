<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nuptk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['nuptk', 'kontak','foto_dosen'];

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'nuptk');
    }
}
