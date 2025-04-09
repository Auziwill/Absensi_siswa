<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lokal extends Model
{
    protected $fillable = ['nama', 'id_jurusan', 'id_guru'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru','id');
    }
}
