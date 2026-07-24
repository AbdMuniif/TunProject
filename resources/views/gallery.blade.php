@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-br from-indigo-900 to-indigo-700 text-white">
    <div class="container-custom text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Photo Gallery</h1>
        <p class="text-xl text-indigo-200">Moments captured through the years</p>
    </div>
</section>

<!-- Gallery -->
<section class="section-padding bg-white">
    <div class="container-custom">
        @if($images->count() > 0)
            @foreach($images as $category => $categoryImages)
                <div class="mb-16" data-aos="fade-up">
                    @if($category)
                        <h2 class="text-3xl font-bold text-gray-900 mb-8 pb-4 border-b-2 border-indigo-500">
                            {{ $category }}
                        </h2>
                    @else
                        <h2 class="text-3xl font-bold text-gray-900 mb-8 pb-4 border-b-2 border-indigo-500">
                            Uncategorized
                        </h2>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($categoryImages as $index => $image)
                            <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 cursor-pointer" 
                                 data-aos="zoom-in" 
                                 data-aos-delay="{{ $index * 50 }}"
                                 onclick="openModal('{{ Storage::url($image->image) }}', '{{ $image->title }}', '{{ $image->description }}')">
                                
                                <img src="{{ Storage::url($image->image) }}" 
                                     alt="{{ $image->title }}" 
                                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                
                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-4 text-white">
                                        <h3 class="font-bold text-lg">{{ $image->title }}</h3>
                                        @if($image->description)
                                            <p class="text-sm text-gray-200">{{ Str::limit($image->description, 60) }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-20" data-aos="fade-up">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-600 mb-2">No images yet</h3>
                <p class="text-gray-500">Check back soon for photos</p>
            </div>
        @endif
    </div>
</section>

<!-- Modal for Full Image View -->
<div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center p-4" onclick="closeModal()">
    <button onclick="closeModal()" class="absolute top-4 right-4 text-white text-4xl hover:text-gray-300">
        &times;
    </button>
    
    <div class="max-w-5xl w-full" onclick="event.stopPropagation()">
        <img id="modalImage" src="" alt="" class="w-full h-auto rounded-lg shadow-2xl">
        <div class="text-white mt-4 text-center">
            <h3 id="modalTitle" class="text-2xl font-bold mb-2"></h3>
            <p id="modalDescription" class="text-gray-300"></p>
        </div>
    </div>
</div>

<script>
function openModal(imageSrc, title, description) {
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description || '';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});
</script>

@endsection