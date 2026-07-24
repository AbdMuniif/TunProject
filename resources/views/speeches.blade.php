@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-br from-green-900 to-green-700 text-white">
    <div class="container-custom text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Speeches</h1>
        <p class="text-xl text-green-200">Words that inspired a nation</p>
    </div>
</section>

<!-- Speeches List -->
<section class="section-padding bg-white">
    <div class="container-custom">
        @if($speeches->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($speeches as $index => $speech)
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 50 }}">
                        
                        @if($speech->thumbnail)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ Storage::url($speech->thumbnail) }}" 
                                     alt="{{ $speech->title }}" 
                                     class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="text-sm text-gray-600 mb-3">
                                {{ $speech->speech_date ? $speech->speech_date->format('M d, Y') : '' }}
                                @if($speech->location)
                                    <span class="mx-2">•</span>
                                    <span>{{ $speech->location }}</span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $speech->title }}</h3>
                            
                            @if($speech->description)
                                <p class="text-gray-600 mb-4">{{ Str::limit($speech->description, 120) }}</p>
                            @endif

                            <div class="flex items-center justify-between">
                                <a href="{{ route('speech.show', $speech->id) }}" 
                                   class="text-green-600 font-semibold hover:text-green-800 inline-flex items-center">
                                    Read More
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>

                                @if($speech->video_url)
                                    <span class="text-red-600 text-sm flex items-center">
                                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                                        </svg>
                                        Video
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $speeches->links() }}
            </div>
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No speeches yet</h3>
                <p class="text-gray-500">Check back soon for updates</p>
            </div>
        @endif
    </div>
</section>

@endsection