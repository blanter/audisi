<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    protected $fillable = ['id_peserta', 'id_juri', 'penilaian', 'total_score'];
    protected $casts = [
        'penilaian' => 'array',
    ];
}
