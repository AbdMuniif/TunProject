@extends('layouts.app')

@section('content')

<!-- Page Header -->
<section class="relative py-20 bg-gradient-to-br from-teal-900 to-teal-700 text-white">
    <div class="container-custom text-center" data-aos="fade-up">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Get in Touch</h1>
        <p class="text-xl text-teal-200">We'd love to hear from you</p>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            <!-- Contact Information -->
            <div data-aos="fade-right">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Contact Information</h2>
                
                <div class="space-y-6">
                    @if(App\Helpers\SiteHelper::settings()->contact_email)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Email</h3>
                                <p class="text-gray-600">{{ App\Helpers\SiteHelper::settings()->contact_email }}</p>
                            </div>
                        </div>
                    @endif

                    @if(App\Helpers\SiteHelper::settings()->contact_phone)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Phone</h3>
                                <p class="text-gray-600">{{ App\Helpers\SiteHelper::settings()->contact_phone }}</p>
                            </div>
                        </div>
                    @endif

                    @if(App\Helpers\SiteHelper::settings()->contact_address)
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-900">Address</h3>
                                <p class="text-gray-600">{{ App\Helpers\SiteHelper::settings()->contact_address }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Social Media -->
                @if(App\Helpers\SiteHelper::socialMedia()->count() > 0)
                    <div class="mt-12">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                            @foreach(App\Helpers\SiteHelper::socialMedia() as $social)
                                <a href="{{ $social->url }}" 
                                   target="_blank" 
                                   class="w-12 h-12 bg-teal-100 hover:bg-teal-600 text-teal-600 hover:text-white rounded-full flex items-center justify-center text-xl transition-all duration-300 transform hover:scale-110">
                                    @if($social->platform === 'Facebook')
                                        📘
                                    @elseif($social->platform === 'Twitter')
                                        🐦
                                    @elseif($social->platform === 'Instagram')
                                        📷
                                    @elseif($social->platform === 'YouTube')
                                        📺
                                    @elseif($social->platform === 'LinkedIn')
                                        💼
                                    @else
                                        🔗
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Contact Form -->
            <div data-aos="fade-left">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">Send a Message</h2>
                
                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                               placeholder="Your name">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                               placeholder="your@email.com">
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                               placeholder="How can we help?">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="5" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all"
                                  placeholder="Your message..."></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full bg-teal-600 hover:bg-teal-700 text-white font-semibold px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        Send Message
                    </button>
                </form>

                <p class="mt-4 text-sm text-gray-500 text-center">
                    * This is a demo form. Form submission functionality needs to be implemented.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection