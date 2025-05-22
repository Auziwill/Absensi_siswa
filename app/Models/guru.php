<?php

namespace App\Models;


use App\Models\Absen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'user_id',
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

    public function absens()
    {
        return $this->hasMany(Absen::class, 'id_guru');
    }

        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function notifications()
    {
        return $this->hasMany(\App\Models\Notification::class, 'id_guru', 'id');
    }

}