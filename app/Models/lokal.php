<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class lokal extends Model
{
    protected $fillable = ['tingkat_kelas', 'tahun_ajaran', 'id_guru', 'id_jurusan'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'lokal_id');
    }
}
