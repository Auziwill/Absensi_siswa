<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nisn', 'alamat', 'jk',  'nohp', 'username', 'password', 'nohp_wm', 'nama_wm', 'alamat_wm', 'id_local', 'id_user'];


    public function local()
    {
        return $this->belongsTo(lokal::class, 'id_local');
    }
    
    public function siswaCollection()
    {
        return $this->hasMany(siswa::class, 'id_user');
    }
}
