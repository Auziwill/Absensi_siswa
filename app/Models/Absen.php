<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $table = 'absensis';
    protected $fillable = [
        'siswa_id',
        'id_guru',
        'tanggal_absen',
        'jam_absen',
        'status',
        'keterangan',
    ];
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public static function sudahAbsen($siswa_id)
    {
        return self::where('siswa_id', $siswa_id)
            ->whereDate('tanggal_absen', now()->toDateString())
            ->exists();
    }
    
}