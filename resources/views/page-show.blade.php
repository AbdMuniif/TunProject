@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-br from-slate-900 to-slate-700 text-white">
    <div class="container-custom text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-bold">{{ $page->title }}</h1>
    </div>
</section>

<!-- Page Content -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="max-w-5xl mx-auto">
            
            <!-- Featured Image -->
            @if($page->featured_image)
                <div class="mb-12" data-aos="fade-up">
                    <img src="{{ Storage::url($page->featured_image) }}" 
                         alt="{{ $page->title }}" 
                         class="w-full rounded-2xl shadow-2xl">
                </div>
            @endif

            <!-- Content -->
            <div class="prose prose-lg max-w-none" data-aos="fade-up">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</section>

@endsection