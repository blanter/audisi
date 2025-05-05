<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'nama_panitia', 'nama_task', 'penanggung_jawab',
        'anggota', 'deskripsi'
    ];

    protected $casts = [
        'anggota' => 'array',
        'deskripsi' => 'array',
    ];
}
