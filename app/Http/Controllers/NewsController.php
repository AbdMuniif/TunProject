<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::where('is_published', true)
            ->orderBy('published_date', 'desc')
            ->paginate(9);

        return view('news', compact('news'));
    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $relatedNews = News::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('news-show', compact('article', 'relatedNews'));
    }
}