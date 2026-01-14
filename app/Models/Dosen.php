<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'nuptk';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['user_id', 'nuptk', 'kontak', 'foto_dosen'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pembimbing()
    {
        return $this->hasMany(Pembimbing::class, 'nuptk');
    }
}
