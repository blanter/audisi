<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentConfig extends Model
{
    protected $fillable = ['jenis_karya','level', 'art_type', 'title', 'type', 'options'];
    protected $casts = [
        'options' => 'array',
    ];
}
