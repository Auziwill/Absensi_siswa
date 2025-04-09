<?php
// filepath: /c:/xampp/htdocs/absensi-siswa/app/Models/Guru.php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Guru extends Authenticatable
{
    protected $fillable = [
        'nama',
        'nip',
        'nohp',
        'jk',
        'tanggal_lahir',
        'username',
        'password',
        'id_user'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Mutator to hash password before saving to database
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}