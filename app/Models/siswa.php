<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nisn', 'alamat', 'jk',  'nohp', 'username', 'password', 
    'nohp_wm', 'nama_wm', 'alamat_wm', 'lokal_id', 'user_id'];


    public function lokal()
    {
        return $this->belongsTo(Lokal::class, 'lokal_id');
    }
    
    
    public function pengajuan()
    {
        return $this->hasMany(pengajuan::class, 'siswa_id');
    }
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function absens()
    {
        return $this->hasMany(Absen::class, 'siswa_id');
    }

}