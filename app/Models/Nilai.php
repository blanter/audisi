<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['id_peserta', 'id_juri', 'penilaian', 'level', 'tipe', 'total_score'];
    protected $casts = [
        'penilaian' => 'array',
    ];
}
