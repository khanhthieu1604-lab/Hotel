<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success/Error Messages -->
            @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg animate-fade-in-up">
                <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
            </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="antigravity-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold uppercase">Total Bookings</p>
                            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $stats['total_bookings'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-calendar-check text-blue-600 dark:text-blue-400 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="antigravity-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold uppercase">Upcoming Stays</p>
                            <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-2">{{ $stats['upcoming_stays'] }}</p>
                        </div>
                        <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-hotel text-purple-600 dark:text-purple-400 text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="antigravity-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold uppercase">Total Spent</p>
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">${{ number_format($stats['total_spent'], 2) }}</p>
                        </div>
                        <div class="w-14 h-14 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-dollar-sign text-green-600 dark:text-green-400 text-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Bookings -->
            <div class="antigravity-card p-6 mb-8">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-calendar-days text-blue-500"></i> Upcoming Bookings
                </h3>

                @if($upcomingBookings->isEmpty())
                <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-calendar-xmark text-4xl mb-3 opacity-50"></i>
                    <p>No upcoming bookings</p>
                    <a href="/" class="uiverse-btn mt-4 inline-block px-6 py-2 rounded-lg text-sm">
                        Book Now
                    </a>
                </div>
                @else
                <div class="space-y-4">
                    @foreach($upcomingBookings as $booking)
                    <div class="border-l-4 border-blue-600 pl-4 py-3 bg-gray-50 dark:bg-gray-800 rounded-r-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 dark:text-white">{{ $booking->room->hotel->name }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $booking->room->type }}</p>
                                <div class="flex items-center gap-4 mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    <span><i class="fa-solid fa-calendar-day mr-1"></i> {{ \Carbon\Carbon::parse($booking->check_in)->format('M d') }}</span>
                                    <span><i class="fa-solid fa-arrow-right"></i></span>
                                    <span><i class="fa-solid fa-calendar-day mr-1"></i> {{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="antigravity-card p-6">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-bolt text-yellow-500"></i> Quick Actions
                </h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="/" class="flex flex-col items-center justify-center p-6 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition group">
                        <i class="fa-solid fa-magnifying-glass text-3xl text-blue-600 mb-3 group-hover:scale-110 transition"></i>
                        <span class="font-semibold text-sm text-center">Browse Hotels</span>
                    </a>

                    <a href="{{ route('bookings.index') }}" class="flex flex-col items-center justify-center p-6 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition group">
                        <i class="fa-solid fa-list text-3xl text-purple-600 mb-3 group-hover:scale-110 transition"></i>
                        <span class="font-semibold text-sm text-center">My Bookings</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>