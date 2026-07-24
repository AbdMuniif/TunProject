@extends('layouts.app')

@section('content')

<!-- Article Header -->
<section class="relative py-20 bg-gradient-to-br from-purple-900 to-purple-700 text-white">
    <div class="container-custom" data-aos="fade-up">
        <div class="max-w-4xl mx-auto">
            @if($article->is_featured)
                <span class="inline-block bg-yellow-400 text-yellow-900 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Featured Article
                </span>
            @endif
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $article->title }}</h1>
            <div class="flex items-center text-purple-200 space-x-4">
                <span>{{ $article->published_date ? $article->published_date->format('F d, Y') : '' }}</span>
                @if($article->author)
                    <span>•</span>
                    <span>By {{ $article->author }}</span>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            
            <!-- Featured Image -->
            @if($article->featured_image)
                <div class="mb-12" data-aos="fade-up">
                    <img src="{{ Storage::url($article->featured_image) }}" 
                         alt="{{ $article->title }}" 
                         class="w-full rounded-2xl shadow-2xl">
                </div>
            @endif

            <!-- Excerpt -->
            @if($article->excerpt)
                <div class="mb-8" data-aos="fade-up">
                    <p class="text-2xl text-gray-700 leading-relaxed font-medium">{{ $article->excerpt }}</p>
                </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none" data-aos="fade-up">
                {!! $article->content !!}
            </div>

            <!-- Share & Back -->
            <div class="mt-12 pt-8 border-t border-gray-200 flex items-center justify-between" data-aos="fade-up">
                <a href="{{ route('news') }}" 
                   class="inline-flex items-center text-purple-600 hover:text-purple-800 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to News
                </a>

                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Share:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                       target="_blank" 
                       class="text-blue-600 hover:text-blue-800">
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" 
                       target="_blank" 
                       class="text-sky-600 hover:text-sky-800">
                        Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related News -->
@if($relatedNews->count() > 0)
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center" data-aos="fade-up">Related Articles</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($relatedNews as $index => $related)
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 100 }}">
                    
                    @if($related->featured_image)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ Storage::url($related->featured_image) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        </div>
                    @endif

                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-2 hover:text-purple-600 transition-colors">
                            <a href="{{ route('news.show', $related->slug) }}">{{ $related->title }}</a>
                        </h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($related->excerpt, 80) }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection