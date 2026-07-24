@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-br from-purple-900 to-purple-700 text-white">
    <div class="container-custom text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">News & Updates</h1>
        <p class="text-xl text-purple-200">Stay informed with the latest developments</p>
    </div>
</section>

<!-- News List -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $index => $article)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" 
                             data-aos="fade-up" 
                             data-aos-delay="{{ $index * 50 }}">
                        
                        @if($article->featured_image)
                            <div class="h-56 overflow-hidden">
                                <img src="{{ Storage::url($article->featured_image) }}" 
                                     alt="{{ $article->title }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-sm text-gray-500">
                                    {{ $article->published_date ? $article->published_date->format('M d, Y') : '' }}
                                </span>
                                @if($article->is_featured)
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        Featured
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-purple-600 transition-colors">
                                <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                            </h3>

                            @if($article->excerpt)
                                <p class="text-gray-600 mb-4">{{ Str::limit($article->excerpt, 120) }}</p>
                            @endif

                            @if($article->author)
                                <div class="text-sm text-gray-500 mb-4">
                                    By {{ $article->author }}
                                </div>
                            @endif

                            <a href="{{ route('news.show', $article->slug) }}" 
                               class="text-purple-600 font-semibold hover:text-purple-800 inline-flex items-center">
                                Read Full Article
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No news articles yet</h3>
                <p class="text-gray-500">Check back soon for updates</p>
            </div>
        @endif
    </div>
</section>

@endsection