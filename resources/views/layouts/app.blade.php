<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? App\Helpers\SiteHelper::settings()->site_name }}</title>
    <meta name="description" content="{{ $description ?? App\Helpers\SiteHelper::settings()->site_tagline }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: {{ App\Helpers\SiteHelper::settings()->primary_color ?? '#1e40af' }};
            --secondary-color: {{ App\Helpers\SiteHelper::settings()->secondary_color ?? '#059669' }};
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="container-custom">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3">
                    @if(App\Helpers\SiteHelper::settings()->logo)
                        <img src="{{ Storage::url(App\Helpers\SiteHelper::settings()->logo) }}" 
                             alt="Logo" 
                             class="h-12 w-auto">
                    @endif
                    <span class="text-2xl font-bold text-gray-800">
                        {{ App\Helpers\SiteHelper::settings()->site_name }}
                    </span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">Home</a>
                    
                    @foreach(App\Helpers\SiteHelper::menuPages() as $page)
                        <a href="{{ route('page.show', $page->slug) }}" class="text-gray-700 hover:text-primary transition-colors font-medium">
                            {{ $page->title }}
                        </a>
                    @endforeach
                    
                    <a href="{{ route('achievements') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">Achievements</a>
                    <a href="{{ route('speeches') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">Speeches</a>
                    <a href="{{ route('news') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">News</a>
                    <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">Gallery</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-primary transition-colors font-medium">Contact</a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-primary transition-colors">Home</a>
                
                @foreach(App\Helpers\SiteHelper::menuPages() as $page)
                    <a href="{{ route('page.show', $page->slug) }}" class="block py-2 text-gray-700 hover:text-primary transition-colors">
                        {{ $page->title }}
                    </a>
                @endforeach
                
                <a href="{{ route('achievements') }}" class="block py-2 text-gray-700 hover:text-primary transition-colors">Achievements</a>
                <a href="{{ route('speeches') }}" class="block py-2 text-gray-700 hover:text-primary transition-colors">Speeches</a>
                <a href="{{ route('news') }}" class="block py-2 text-gray-700 hover:text-primary transition-colors">News</a>
                <a href="{{ route('gallery') }}" class="block py-2 text-gray-700 hover:text-primary transition-colors">Gallery</a>
                <a href="{{ route('contact') }}" class="block py-2 text-gray-700 hover:text-primary transition-colors">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container-custom">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4">{{ App\Helpers\SiteHelper::settings()->site_name }}</h3>
                    <p class="text-gray-400">
                        {{ App\Helpers\SiteHelper::settings()->site_tagline }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('achievements') }}" class="text-gray-400 hover:text-white transition-colors">Achievements</a></li>
                        <li><a href="{{ route('speeches') }}" class="text-gray-400 hover:text-white transition-colors">Speeches</a></li>
                        <li><a href="{{ route('news') }}" class="text-gray-400 hover:text-white transition-colors">News</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-gray-400 hover:text-white transition-colors">Gallery</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div>
                    <h3 class="text-xl font-bold mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        @foreach(App\Helpers\SiteHelper::socialMedia() as $social)
                            <a href="{{ $social->url }}" target="_blank" class="text-gray-400 hover:text-white transition-colors text-2xl">
                                @if($social->platform === 'Facebook')
                                    📘
                                @elseif($social->platform === 'Twitter')
                                    🐦
                                @elseif($social->platform === 'Instagram')
                                    📷
                                @elseif($social->platform === 'YouTube')
                                    📺
                                @else
                                    🔗
                                @endif
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-6 text-gray-400">
                        @if(App\Helpers\SiteHelper::settings()->contact_email)
                            <p class="mb-2">📧 {{ App\Helpers\SiteHelper::settings()->contact_email }}</p>
                        @endif
                        @if(App\Helpers\SiteHelper::settings()->contact_phone)
                            <p>📞 {{ App\Helpers\SiteHelper::settings()->contact_phone }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>{{ App\Helpers\SiteHelper::settings()->footer_text ?? '© 2026 All Rights Reserved' }}</p>
            </div>
        </div>
    </footer>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>