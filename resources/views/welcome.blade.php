<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KThiuu Hotel - Premium Hotel Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <!-- Navbar -->
    <header class="fixed w-full top-0 z-50 bg-white/10 backdrop-blur-md border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-600">
                        <i class="fa-solid fa-hotel"></i> KThiuu Hotel
                    </a>
                </div>
                <nav class="flex gap-6 items-center">
                    @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium hover:text-blue-500 transition">Dashboard</a>
                    <a href="{{ route('bookings.index') }}" class="text-sm font-medium hover:text-blue-500 transition">My Bookings</a>
                    @else
                    <a href="{{ route('login') }}" class="text-sm font-medium hover:text-blue-500 transition">Log in</a>
                    <a href="{{ route('register') }}" class="uiverse-btn px-6 py-2 rounded-full text-sm">Get Started</a>
                    @endauth
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-gray-900 via-purple-900 to-blue-900">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80"
                alt="Luxury Hotel"
                class="w-full h-full object-cover opacity-25">
            <div class="absolute inset-0 bg-gradient-to-br from-black/80 via-purple-900/70 to-blue-900/80"></div>
        </div>

        <!-- Floating Particles -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-1">
            <div class="absolute top-1/4 left-1/4 w-4 h-4 bg-white/30 rounded-full animate-float"></div>
            <div class="absolute top-1/2 right-1/4 w-3 h-3 bg-pink-300/40 rounded-full animate-float-delay-1"></div>
            <div class="absolute bottom-1/3 left-1/3 w-5 h-5 bg-blue-300/30 rounded-full animate-float-delay-2"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center px-6 max-w-6xl mx-auto mt-20">
            <div class="mb-8 animate-fade-in-up">
                <div class="inline-block px-6 py-3 bg-white/10 backdrop-blur-md rounded-full border border-white/30 text-white text-sm font-semibold shadow-xl">
                    ✨ Antigravity Experience
                </div>
            </div>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-8 leading-tight animate-fade-in-up drop-shadow-2xl">
                Discover Your Perfect <br class="hidden md:block">
                <span class="inline-block mt-2 bg-clip-text text-transparent bg-gradient-to-r from-blue-300 via-purple-300 to-pink-300">Stay</span>
            </h1>

            <p class="text-xl md:text-2xl text-gray-100 mb-12 max-w-3xl mx-auto leading-relaxed font-light animate-fade-in-up" style="animation-delay: 0.2s;">
                Experience luxury and comfort in our handpicked locations. Your perfect stay awaits.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center animate-fade-in-up" style="animation-delay: 0.4s;">
                <a href="#hotels" class="uiverse-btn px-10 py-5 rounded-xl text-lg font-bold shadow-2xl hover:scale-105 transition-all duration-300 min-w-[220px]">
                    <i class="fa-solid fa-hotel mr-2"></i> Explore Hotels
                </a>
                @guest
                <a href="{{ route('register') }}" class="px-10 py-5 rounded-xl text-lg font-bold bg-white/10 backdrop-blur-md text-white border-2 border-white/40 hover:bg-white/20 hover:border-white/60 transition-all duration-300 shadow-xl min-w-[220px]">
                    <i class="fa-solid fa-user-plus mr-2"></i> Sign Up
                </a>
                @endguest
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-10 animate-fade-in-up" style="animation-delay: 0.6s;">
            <a href="#hotels" class="flex flex-col items-center gap-2 text-white/80 hover:text-white transition group">
                <span class="text-sm font-semibold uppercase tracking-wider">Scroll Down</span>
                <i class="fa-solid fa-chevron-down text-2xl animate-bounce group-hover:translate-y-1 transition"></i>
            </a>
        </div>
    </section>

    <!-- Hotels Section -->
    <section id="hotels" class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-extrabold mb-4">
                    Our <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">Premium</span> Locations
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400">Handpicked destinations for your perfect stay</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                @foreach($hotels as $hotel)
                <div class="antigravity-card overflow-hidden group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $hotel->image ?? 'https://placehold.co/600x400' }}"
                            alt="{{ $hotel->name }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 dark:bg-gray-800/90 px-3 py-1 rounded-full flex items-center gap-1">
                            <i class="fa-solid fa-star text-yellow-500 text-sm"></i>
                            <span class="font-bold text-sm">{{ $hotel->rating }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2 bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-purple-600">
                            {{ $hotel->name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-4 flex items-center">
                            <i class="fa-solid fa-location-dot mr-2"></i> {{ $hotel->address }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 line-clamp-2">{{ $hotel->description }}</p>

                        <!-- Rooms Grid -->
                        <div class="space-y-3 mb-6">
                            <h4 class="font-bold text-sm uppercase text-gray-700 dark:text-gray-300">Available Rooms</h4>
                            @foreach($hotel->rooms as $room)
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                <div>
                                    <p class="font-semibold">{{ $room->type }}</p>
                                    <p class="text-xs text-gray-500">{{ $room->capacity }} guests</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-blue-600">${{ $room->price }}<span class="text-xs text-gray-500">/night</span></p>
                                    @auth
                                    <a href="{{ route('bookings.create', $room) }}" class="text-xs text-purple-600 hover:text-purple-800 font-semibold">Book →</a>
                                    @else
                                    <a href="{{ route('login') }}" class="text-xs text-gray-500 hover:text-gray-700">Login to book</a>
                                    @endauth
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6 text-center">
            <div class="mb-4">
                <h3 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-purple-600">
                    <i class="fa-solid fa-hotel"></i> KThiuu Hotel
                </h3>
            </div>
            <p class="text-gray-400 mb-6">Premium hotel booking experience</p>
            <div class="flex justify-center gap-6 mb-6">
                <a href="#" class="text-gray-400 hover:text-white transition"><i class="fa-brands fa-facebook text-2xl"></i></a>
                <a href="#" class="text-gray-400 hover:text-white transition"><i class="fa-brands fa-twitter text-2xl"></i></a>
                <a href="#" class="text-gray-400 hover:text-white transition"><i class="fa-brands fa-instagram text-2xl"></i></a>
            </div>
            <p class="text-sm text-gray-500">© 2026 KThiuu Hotel. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>