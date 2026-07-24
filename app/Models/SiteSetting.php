<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'site_tagline',
        'logo',
        'favicon',
        'contact_email',
        'contact_phone',
        'contact_address',
        'footer_text',
        'primary_color',
        'secondary_color',
    ];
}