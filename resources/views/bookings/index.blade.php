<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Bookings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg animate-fade-in-up flex items-center gap-2">
                <i class="fa-solid fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 rounded-lg animate-fade-in-up flex items-center gap-2">
                <i class="fa-solid fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif

            @if($bookings->isEmpty())
            <div class="antigravity-card p-12 text-center">
                <div class="text-6xl text-gray-200 dark:text-gray-700 mb-4">
                    <i class="fa-solid fa-suitcase-rolling"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-2">No bookings found</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6">You haven't made any hotel bookings yet.</p>
                <a href="/" class="uiverse-btn px-8 py-3 rounded-lg inline-block">
                    <i class="fa-solid fa-hotel mr-2"></i> Browse Hotels
                </a>
            </div>
            @else
            <div class="space-y-6">
                @foreach($bookings as $booking)
                <div class="antigravity-card overflow-hidden flex flex-col md:flex-row">
                    <div class="md:w-1/4">
                        <img src="{{ $booking->room->image ?? 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304' }}"
                            class="w-full h-48 md:h-full object-cover">
                    </div>
                    <div class="p-6 md:w-3/4 flex flex-col justify-between">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold">{{ $booking->room->hotel->name }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ $booking->room->type }}</p>
                            </div>
                            <div class="text-right">
                                @php
                                $statusColors = [
                                'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                'completed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                ];
                                $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $statusColor }}">
                                    {{ $booking->status }}
                                </span>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">#{{ $booking->id }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4 text-sm">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 uppercase text-xs font-bold">Check-in</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 uppercase text-xs font-bold">Check-out</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($booking->check_out)->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 uppercase text-xs font-bold">Total Price</p>
                                <p class="font-semibold text-blue-600 dark:text-blue-400">${{ number_format($booking->total_price, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400 uppercase text-xs font-bold">Payment</p>
                                <p class="font-semibold capitalize">{{ $booking->payment_status }}</p>
                            </div>
                        </div>

                        <div class="flex justify-end items-center gap-4">
                            @if($booking->status !== 'cancelled' && $booking->status !== 'completed' && \Carbon\Carbon::parse($booking->check_in)->isFuture())
                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">
                                    <i class="fa-solid fa-ban mr-1"></i> Cancel Booking
                                </button>
                            </form>
                            @endif
                            <a href="/" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-semibold text-sm">
                                <i class="fa-solid fa-hotel mr-1"></i> Browse More Hotels
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>