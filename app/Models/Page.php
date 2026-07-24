<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'is_published',
        'order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Auto-generate slug from title
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }
}