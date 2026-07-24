@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-br from-green-900 to-green-700 text-white">
    <div class="container-custom" data-aos="fade-up">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $speech->title }}</h1>
            <div class="text-lg text-green-200">
                {{ $speech->speech_date ? $speech->speech_date->format('F d, Y') : '' }}
                @if($speech->location)
                    <span class="mx-3">•</span>
                    <span>{{ $speech->location }}</span>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Speech Content -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            
            <!-- Video Section -->
            @if($speech->video_url)
                <div class="mb-12" data-aos="fade-up">
                    <div class="aspect-w-16 aspect-h-9 rounded-2xl overflow-hidden shadow-2xl">
                        @if(str_contains($speech->video_url, 'youtube.com') || str_contains($speech->video_url, 'youtu.be'))
                            @php
                                preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\?]+)/', $speech->video_url, $matches);
                                $videoId = $matches[1] ?? null;
                            @endphp
                            @if($videoId)
                                <iframe 
                                    class="w-full h-full min-h-[400px]" 
                                    src="https://www.youtube.com/embed/{{ $videoId }}" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            @endif
                        @elseif(str_contains($speech->video_url, 'vimeo.com'))
                            @php
                                preg_match('/vimeo\.com\/(\d+)/', $speech->video_url, $matches);
                                $videoId = $matches[1] ?? null;
                            @endphp
                            @if($videoId)
                                <iframe 
                                    class="w-full h-full min-h-[400px]" 
                                    src="https://player.vimeo.com/video/{{ $videoId }}" 
                                    frameborder="0" 
                                    allow="autoplay; fullscreen; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            @endif
                        @endif
                    </div>
                </div>
            @elseif($speech->thumbnail)
                <div class="mb-12" data-aos="fade-up">
                    <img src="{{ Storage::url($speech->thumbnail) }}" 
                         alt="{{ $speech->title }}" 
                         class="w-full rounded-2xl shadow-2xl">
                </div>
            @endif

            <!-- Audio Section -->
            @if($speech->audio_file)
                <div class="mb-12 bg-gray-100 p-6 rounded-2xl" data-aos="fade-up">
                    <audio controls class="w-full">
                        <source src="{{ Storage::url($speech->audio_file) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            @endif

            <!-- Description -->
            @if($speech->description)
                <div class="mb-8" data-aos="fade-up">
                    <p class="text-xl text-gray-700 leading-relaxed">{{ $speech->description }}</p>
                </div>
            @endif

            <!-- Full Content -->
            @if($speech->content)
                <div class="prose prose-lg max-w-none" data-aos="fade-up">
                    {!! $speech->content !!}
                </div>
            @endif

            <!-- Back Button -->
            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ route('speeches') }}" 
                   class="inline-flex items-center text-green-600 hover:text-green-800 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Speeches
                </a>
            </div>
        </div>
    </div>
</section>

@endsection