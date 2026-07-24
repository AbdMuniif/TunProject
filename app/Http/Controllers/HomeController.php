<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Speech;
use App\Models\News;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\SocialMedia;

class HomeController extends Controller
{
    public function index()
    {
        $featuredAchievements = Achievement::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        $latestNews = News::where('is_published', true)
            ->orderBy('published_date', 'desc')
            ->take(3)
            ->get();

        $featuredSpeeches = Speech::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('speech_date', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('featuredAchievements', 'latestNews', 'featuredSpeeches'));
    }

    public function achievements()
    {
        $achievements = Achievement::where('is_published', true)
            ->orderBy('order')
            ->get();

        return view('achievements', compact('achievements'));
    }

    public function speeches()
    {
        $speeches = Speech::where('is_published', true)
            ->orderBy('speech_date', 'desc')
            ->paginate(12);

        return view('speeches', compact('speeches'));
    }

    public function speechShow($id)
    {
        $speech = Speech::where('is_published', true)->findOrFail($id);
        return view('speech-show', compact('speech'));
    }

    public function gallery()
    {
        $images = Gallery::where('is_published', true)
            ->orderBy('order')
            ->get()
            ->groupBy('category');

        return view('gallery', compact('images'));
    }

    public function contact()
    {
        return view('contact');
    }
}