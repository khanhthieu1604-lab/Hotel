<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KThiuu Hotel - Luxury Accommodation in the Heart of the City</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-cream dark:bg-gray-900">

    <!-- Elegant Header -->
    <header class="sticky top-0 z-50 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 via-yellow-500 to-yellow-400 rounded-full flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-hotel text-brown-900 text-xl"></i>
                    </div>
                    <div>
                        <a href="/" class="text-2xl font-bold text-gray-900 dark:text-white" style="font-family: 'Playfair Display', serif;">KThiuu Hotel</a>
                        <p class="text-xs text-gray-600 dark:text-gray-400" style="letter-spacing: 2px;">LUXURY ACCOMMODATION</p>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex gap-8 items-center">
                    <a href="/" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-yellow-600 dark:hover:text-yellow-400 transition uppercase tracking-wide">Home</a>
                    <a href="#hotels" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-yellow-600 dark:hover:text-yellow-400 transition uppercase tracking-wide">Suites & Rooms</a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-yellow-600 transition uppercase tracking-wide">My Account</a>
                    @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-orange-600 hover:text-orange-700 transition uppercase tracking-wide">Admin</a>
                    @endif
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-700 dark:text-gray-300 hover:text-yellow-600 transition uppercase tracking-wide">Sign In</a>
                    @endauth
                    <a href="#hotels" class="gold-btn px-6 py-3 rounded-md text-xs">Book Now</a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section with Booking Form -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                alt="Luxury Hotel"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 grid md:grid-cols-2 gap-12 items-center">
            <!-- Left: Text Content -->
            <div class="text-white">
                <div class="inline-block px-6 py-2 bg-yellow-600/20 backdrop-blur-sm border border-yellow-500/30 rounded-full text-sm font-semibold mb-6 animate-fade-in-up" style="letter-spacing: 2px;">
                    ★★★★★ LUXURY EXPERIENCE
                </div>

                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.1s; font-family: 'Playfair Display', serif;">
                    IN THE<br>
                    <span class="text-yellow-400">HEART</span> OF<br>
                    THE CITY
                </h1>

                <p class="text-xl text-gray-200 mb-8 leading-relaxed animate-fade-in-up" style="animation-delay: 0.2s;">
                    Experience unparalleled luxury and comfort in our meticulously designed suites and rooms. Your perfect stay awaits.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up" style="animation-delay: 0.3s;">
                    <a href="#hotels" class="gold-btn px-8 py-4 rounded-md inline-flex items-center justify-center">
                        <i class="fa-solid fa-crown mr-2"></i> Explore Suites
                    </a>
                    <a href="#hotels" class="gold-btn-outline px-8 py-4 rounded-md inline-flex items-center justify-center">
                        <i class="fa-solid fa-phone mr-2"></i> Contact Us
                    </a>
                </div>
            </div>

            <!-- Right: Booking Form (Optional - can be enabled) -->
            <div class="booking-form animate-fade-in-up hidden md:block" style="animation-delay: 0.4s;">
                <h3 class="text-2xl font-bold text-white mb-6 text-center" style="font-family: 'Playfair Display', serif;">Reserve Your Suite</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">CHECK-IN DATE</label>
                        <input type="date" class="w-full px-4 py-3 bg-white/10 border border-yellow-600/30 rounded-md text-white placeholder-gray-400 focus:border-yellow-500 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-300 mb-2">CHECK-OUT DATE</label>
                        <input type="date" class="w-full px-4 py-3 bg-white/10 border border-yellow-600/30 rounded-md text-white placeholder-gray-400 focus:border-yellow-500 focus:outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">GUESTS</label>
                            <select class="w-full px-4 py-3 bg-white/10 border border-yellow-600/30 rounded-md text-white focus:border-yellow-500 focus:outline-none">
                                <option>1 Guest</option>
                                <option>2 Guests</option>
                                <option>3 Guests</option>
                                <option>4+ Guests</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-300 mb-2">ROOMS</label>
                            <select class="w-full px-4 py-3 bg-white/10 border border-yellow-600/30 rounded-md text-white focus:border-yellow-500 focus:outline-none">
                                <option>1 Room</option>
                                <option>2 Rooms</option>
                                <option>3+ Rooms</option>
                            </select>
                        </div>
                    </div>
                    <button type="button" onclick="window.location.href='#hotels'" class="w-full gold-btn py-4 rounded-md font-bold text-sm">
                        CHECK AVAILABILITY
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="section-title text-4xl md:text-5xl mb-4 inline-block">Our Services</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-6 text-lg">Experience luxury at every touchpoint</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="icon-feature mb-4">
                        <i class="fa-solid fa-wifi text-brown-900 text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Free WiFi</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">High-speed internet</p>
                </div>
                <div class="text-center group">
                    <div class="icon-feature mb-4">
                        <i class="fa-solid fa-concierge-bell text-brown-900 text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Room Service</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">24/7 available</p>
                </div>
                <div class="text-center group">
                    <div class="icon-feature mb-4">
                        <i class="fa-solid fa-spa text-brown-900 text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Spa & Wellness</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Relaxation center</p>
                </div>
                <div class="text-center group">
                    <div class="icon-feature mb-4">
                        <i class="fa-solid fa-utensils text-brown-900 text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 dark:text-white mb-2">Restaurant</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Fine dining</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Suites & Rooms Section -->
    <section id="hotels" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="section-title text-4xl md:text-5xl mb-4 inline-block">Suites & Rooms</h2>
                <p class="text-gray-600 dark:text-gray-400 mt-6 text-lg">Elegance meets comfort in every room</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @foreach($hotels as $hotel)
                <div class="luxury-card overflow-hidden rounded-lg">
                    <div class="relative h-80 overflow-hidden group">
                        <img src="{{ $hotel->image }}"
                            alt="{{ $hotel->name }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-yellow-600 text-brown-900 px-4 py-2 rounded-md shadow-lg font-bold">
                            <i class="fa-solid fa-star"></i> {{ $hotel->rating }}
                        </div>
                    </div>

                    <div class="p-8">
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-3" style="font-family: 'Playfair Display', serif;">
                            {{ $hotel->name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-2 flex items-center">
                            <i class="fa-solid fa-location-dot mr-2 text-yellow-600"></i> {{ $hotel->address }}
                        </p>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 leading-relaxed">{{ $hotel->description }}</p>

                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="font-bold text-sm uppercase text-gray-700 dark:text-gray-300 mb-4 tracking-widest">Available Rooms</h4>
                            <div class="space-y-3">
                                @foreach($hotel->rooms as $room)
                                <div class="flex justify-between items-center p-4 bg-gray-50 dark:bg-gray-900 rounded-md border border-gray-200 dark:border-gray-700 hover:border-yellow-500 transition">
                                    <div class="flex-1">
                                        <p class="font-bold text-gray-900 dark:text-white text-lg">{{ $room->type }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <i class="fa-solid fa-users text-yellow-600 mr-1"></i> Up to {{ $room->capacity }} guests
                                        </p>
                                    </div>
                                    <div class="text-right ml-4">
                                        <p class="price-tag">${{ number_format($room->price, 0) }}</p>
                                        <p class="text-xs text-gray-500">per night</p>
                                        @auth
                                        <a href="{{ route('bookings.create', $room) }}" class="gold-btn px-4 py-2 rounded-md text-xs mt-2 inline-block">
                                            BOOK NOW
                                        </a>
                                        @else
                                        <a href="{{ route('login') }}" class="text-xs text-yellow-600 hover:text-yellow-700 mt-2 inline-block">Sign in to book</a>
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
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-400 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-hotel text-brown-900 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold" style="font-family: 'Playfair Display', serif;">KThiuu Hotel</h3>
                            <p class="text-xs text-gray-400" style="letter-spacing: 2px;">LUXURY ACCOMMODATION</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed">Experience unparalleled luxury and comfort. Your perfect stay awaits in the heart of the city.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center hover:bg-yellow-500 transition">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center hover:bg-yellow-500 transition">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-yellow-600 rounded-full flex items-center justify-center hover:bg-yellow-500 transition">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-yellow-400" style="letter-spacing: 1px;">QUICK LINKS</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="/" class="text-gray-400 hover:text-yellow-400 transition">Home</a></li>
                        <li><a href="#hotels" class="text-gray-400 hover:text-yellow-400 transition">Suites & Rooms</a></li>
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-yellow-400 transition">My Account</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4 text-yellow-400" style="letter-spacing: 1px;">CONTACT</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li><i class="fa-solid fa-phone mr-2 text-yellow-600"></i> +1 (800) LUXURY</li>
                        <li><i class="fa-solid fa-envelope mr-2 text-yellow-600"></i> info@kthiuuhotel.com</li>
                        <li><i class="fa-solid fa-clock mr-2 text-yellow-600"></i> 24/7 Support</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>© 2026 KThiuu Hotel. All rights reserved. | Luxury Accommodation Services</p>
            </div>
        </div>
    </footer>

</body>

</html>