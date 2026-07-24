<?php

namespace App\Helpers;

use App\Models\SiteSetting;
use App\Models\SocialMedia;
use App\Models\Page;

class SiteHelper
{
    public static function settings()
    {
        return SiteSetting::first() ?? new SiteSetting();
    }

    public static function socialMedia()
    {
        return SocialMedia::where('is_active', true)
            ->orderBy('order')
            ->get();
    }

    public static function menuPages()
    {
        return Page::where('is_published', true)
            ->orderBy('order')
            ->get();
    }
}