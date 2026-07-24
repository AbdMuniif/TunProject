@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-br from-blue-900 to-blue-700 text-white">
    <div class="container-custom text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Achievements</h1>
        <p class="text-xl text-blue-200">A legacy of excellence and dedication</p>
    </div>
</section>

<!-- Achievements List -->
<section class="section-padding bg-white">
    <div class="container-custom">
        @if($achievements->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($achievements as $index => $achievement)
                    <div class="group bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" 
                         data-aos="fade-up" 
                         data-aos-delay="{{ $index * 50 }}">
                        
                        @if($achievement->image)
                            <div class="mb-6 rounded-xl overflow-hidden">
                                <img src="{{ Storage::url($achievement->image) }}" 
                                     alt="{{ $achievement->title }}" 
                                     class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                        @endif

                        @if($achievement->year)
                            <span class="inline-block bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-semibold mb-4">
                                {{ $achievement->year }}
                            </span>
                        @endif

                        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $achievement->title }}</h3>
                        
                        @if($achievement->description)
                            <p class="text-gray-600 leading-relaxed">{{ $achievement->description }}</p>
                        @endif

                        @if($achievement->is_featured)
                            <div class="mt-4">
                                <span class="inline-flex items-center text-yellow-600 font-semibold">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Featured Achievement
                                </span>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No achievements yet</h3>
                <p class="text-gray-500">Check back soon for updates</p>
            </div>
        @endif
    </div>
</section>

@endsection