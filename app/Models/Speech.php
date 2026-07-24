<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Speech extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'speech_date',
        'location',
        'video_url',
        'audio_file',
        'thumbnail',
        'is_featured',
        'is_published',
    ];

    protected $casts = [
        'speech_date' => 'date',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];
}