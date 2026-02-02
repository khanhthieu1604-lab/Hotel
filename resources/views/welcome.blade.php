<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KThiuu Hotel - Professional Hotel Booking Services</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <!-- Professional Navbar -->
    <header class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-hotel text-white text-xl"></i>
                    </div>
                    <div>
                        <a href="/" class="text-xl font-bold text-gray-900 dark:text-white">KThiuu Hotel</a>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Professional Booking Services</p>
                    </div>
                </div>
                <nav class="flex gap-8 items-center">
                    @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">Dashboard</a>
                    <a href="{{ route('bookings.index') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">My Bookings</a>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-orange-600 dark:text-orange-400 hover:text-orange-700 transition">Admin</a>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 transition">Sign In</a>
                    <a href="{{ route('register') }}" class="corporate-btn px-6 py-2 rounded-md text-sm">Get Started</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-white">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')] bg-cover bg-center opacity-20"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="max-w-3xl">
                <div class="inline-block px-4 py-2 bg-blue-600/50 backdrop-blur-sm rounded-full text-sm font-semibold mb-6 animate-fade-in-up">
                    <i class="fa-solid fa-shield-halved mr-2"></i> Trusted by 10,000+ Customers
                </div>

                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.1s;">
                    Professional Hotel<br>
                    <span class="text-blue-300">Booking Services</span>
                </h1>

                <p class="text-xl text-blue-100 mb-8 leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s;">
                    Experience excellence with our curated selection of premium hotels. Secure booking, competitive rates, and 24/7 support.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="#hotels" class="corporate-btn px-8 py-4 rounded-md text-lg font-semibold inline-flex items-center justify-center">
                        <i class="fa-solid fa-search mr-2"></i> View Hotels
                    </a>
                    <a href="{{ route('register') }}" class="corporate-btn-outline px-8 py-4 rounded-md text-lg font-semibold inline-flex items-center justify-center bg-white/10 backdrop-blur-sm">
                        <i class="fa-solid fa-user-plus mr-2"></i> Create Account
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="grid grid-cols-3 gap-4 mt-12 animate-fade-in-up" style="animation-delay: 0.4s;">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-300">10K+</div>
                        <div class="text-sm text-blue-200">Happy Guests</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-300">98%</div>
                        <div class="text-sm text-blue-200">Satisfaction Rate</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-300">24/7</div>
                        <div class="text-sm text-blue-200">Support</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hotels Section -->
    <section id="hotels" class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <div class="section-divider mx-auto mb-6"></div>
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Our Premium Properties</h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Carefully selected hotels to ensure your comfort and satisfaction
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach($hotels as $hotel)
                <div class="corporate-card overflow-hidden rounded-lg group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $hotel->image ?? 'https://images.unsplash.com/photo-1566073771259-6a8506099945' }}"
                            alt="{{ $hotel->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 px-3 py-1 rounded-md shadow-lg flex items-center gap-1">
                            <i class="fa-solid fa-star text-yellow-500 text-sm"></i>
                            <span class="font-bold text-gray-900 dark:text-white">{{ $hotel->rating }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $hotel->name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4 flex items-center text-sm">
                            <i class="fa-solid fa-location-dot mr-2 text-blue-600"></i> {{ $hotel->address }}
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">{{ $hotel->description }}</p>

                        <!-- Rooms -->
                        <div class="border-t dark:border-gray-700 pt-4">
                            <h4 class="font-bold text-sm uppercase text-gray-700 dark:text-gray-300 mb-3 tracking-wide">Available Rooms</h4>
                            <div class="space-y-2">
                                @foreach($hotel->rooms as $room)
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-md hover:bg-blue-50 dark:hover:bg-blue-900/20 transition border border-gray-200 dark:border-gray-700">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-white">{{ $room->type }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fa-solid fa-users text-blue-600 mr-1"></i> Up to {{ $room->capacity }} guests
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-blue-600 dark:text-blue-400 text-lg">
                                            ${{ number_format($room->price, 0) }}
                                            <span class="text-xs text-gray-500 font-normal">/night</span>
                                        </p>
                                        @auth
                                        <a href="{{ route('bookings.create', $room) }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 font-semibold">
                                            Book Now <i class="fa-solid fa-arrow-right ml-1"></i>
                                        </a>
                                        @else
                                        <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-blue-600">Sign in to book</a>
                                        @endauth
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-hotel text-white"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg">KThiuu Hotel</h3>
                            <p class="text-xs text-gray-400">Professional Booking</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-400">Trusted hotel booking services with competitive rates and 24/7 support.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="/" class="hover:text-white transition">Home</a></li>
                        <li><a href="#hotels" class="hover:text-white transition">Hotels</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Sign In</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Support</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fa-solid fa-phone mr-2"></i> 1-800-HOTEL</li>
                        <li><i class="fa-solid fa-envelope mr-2"></i> support@kthiuuhotel.com</li>
                        <li><i class="fa-solid fa-clock mr-2"></i> 24/7 Available</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 text-center text-sm text-gray-400">
                <p>© 2026 KThiuu Hotel. All rights reserved. | Professional Hotel Booking Services</p>
            </div>
        </div>
    </footer>

</body>

</html>