@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 left-20 w-72 h-72 bg-blue-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-20 w-96 h-96 bg-purple-400 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="container-custom text-center relative z-10" data-aos="fade-up">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
            {{ App\Helpers\SiteHelper::settings()->site_name }}
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-200 max-w-3xl mx-auto">
            {{ App\Helpers\SiteHelper::settings()->site_tagline ?? 'Statesman, Visionary, Leader' }}
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('achievements') }}" class="btn-primary">
                View Achievements
            </a>
            <a href="#latest-news" class="bg-white text-blue-900 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">
                Latest News
            </a>
        </div>
    </div>

    <!-- Scroll indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
        </svg>
    </div>
</section>

<!-- Featured Achievements Section -->
@if($featuredAchievements->count() > 0)
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Key Achievements</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Milestones that shaped a nation</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredAchievements as $index => $achievement)
                <div class="group relative bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}">
                    
                    @if($achievement->image)
                        <div class="mb-6 rounded-xl overflow-hidden">
                            <img src="{{ Storage::url($achievement->image) }}" 
                                 alt="{{ $achievement->title }}" 
                                 class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                    @endif

                    @if($achievement->year)
                        <span class="inline-block bg-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold mb-4">
                            {{ $achievement->year }}
                        </span>
                    @endif

                    <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $achievement->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ Str::limit($achievement->description, 150) }}</p>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('achievements') }}" class="btn-secondary inline-block">
                View All Achievements →
            </a>
        </div>
    </div>
</section>
@endif

<!-- Latest News Section -->
@if($latestNews->count() > 0)
<section id="latest-news" class="section-padding bg-gray-100">
    <div class="container-custom">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Latest News</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Stay updated with recent developments</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestNews as $index => $news)
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 100 }}">
                    
                    @if($news->featured_image)
                        <div class="h-56 overflow-hidden">
                            <img src="{{ Storage::url($news->featured_image) }}" 
                                 alt="{{ $news->title }}" 
                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="text-sm text-gray-500 mb-3">
                            {{ $news->published_date ? $news->published_date->format('M d, Y') : '' }}
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-blue-600 transition-colors">
                            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                        </h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($news->excerpt, 120) }}</p>
                        <a href="{{ route('news.show', $news->slug) }}" class="text-blue-600 font-semibold hover:text-blue-800 inline-flex items-center">
                            Read More 
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('news') }}" class="btn-primary inline-block">
                View All News →
            </a>
        </div>
    </div>
</section>
@endif

<!-- Featured Speeches Section -->
@if($featuredSpeeches->count() > 0)
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Notable Speeches</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">Words that inspired a generation</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($featuredSpeeches as $index => $speech)
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}">
                    
                    @if($speech->thumbnail)
                        <div class="mb-4 rounded-xl overflow-hidden">
                            <img src="{{ Storage::url($speech->thumbnail) }}" 
                                 alt="{{ $speech->title }}" 
                                 class="w-full h-40 object-cover">
                        </div>
                    @endif

                    <div class="text-sm text-gray-600 mb-2">
                        {{ $speech->speech_date ? $speech->speech_date->format('M d, Y') : '' }}
                        @if($speech->location)
                            • {{ $speech->location }}
                        @endif
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $speech->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($speech->description, 100) }}</p>
                    
                    <a href="{{ route('speech.show', $speech->id) }}" class="text-green-600 font-semibold hover:text-green-800 inline-flex items-center">
                        Watch/Read 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('speeches') }}" class="btn-secondary inline-block">
                View All Speeches →
            </a>
        </div>
    </div>
</section>
@endif

<!-- Call to Action -->
<section class="section-padding bg-gradient-to-r from-blue-600 to-blue-800 text-white">
    <div class="container-custom text-center" data-aos="zoom-in">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Explore the Legacy</h2>
        <p class="text-xl mb-8 max-w-3xl mx-auto opacity-90">
            Discover the journey, achievements, and vision that shaped Malaysia's future
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('gallery') }}" class="bg-white text-blue-600 px-8 py-4 rounded-lg font-semibold hover:bg-blue-50 transition-all duration-300 transform hover:scale-105">
                View Gallery
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
                Get in Touch
            </a>
        </div>
    </div>
</section>

@endsection