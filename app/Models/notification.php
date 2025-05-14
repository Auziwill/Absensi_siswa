<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'is_read',
        'id_pengajuan',
        'id_guru',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}