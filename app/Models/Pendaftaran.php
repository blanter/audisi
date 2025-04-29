<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'judul',
        'jenis_karya',
        'tema',
        'storyboard_path',
        'penilaian_guru_path',
        'perkiraan_durasi',
        'list_prop',
        'status',
    ];
}
