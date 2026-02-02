<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="antigravity-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold uppercase">Total Bookings</p>
                            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $stats['total_bookings'] }}</p>
                        </div>
                        <i class="fa-solid fa-calendar-check text-4xl text-blue-200 dark:text-blue-800"></i>
                    </div>
                </div>

                <div class="antigravity-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold uppercase">Pending</p>
                            <p class="text-3xl font-bold text-yellow-600 dark:text-yellow-400 mt-2">{{ $stats['pending_bookings'] }}</p>
                        </div>
                        <i class="fa-solid fa-clock text-4xl text-yellow-200 dark:text-yellow-800"></i>
                    </div>
                </div>

                <div class="antigravity-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold uppercase">Total Revenue</p>
                            <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">${{ number_format($stats['total_revenue'], 2) }}</p>
                        </div>
                        <i class="fa-solid fa-dollar-sign text-4xl text-green-200 dark:text-green-800"></i>
                    </div>
                </div>

                <div class="antigravity-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold uppercase">Hotels</p>
                            <p class="text-3xl font-bold text-purple-600 dark:text-purple-400 mt-2">{{ $stats['total_hotels'] }}</p>
                        </div>
                        <i class="fa-solid fa-hotel text-4xl text-purple-200 dark:text-purple-800"></i>
                    </div>
                </div>
            </div>

            <!-- Recent Bookings -->
            <div class="antigravity-card p-6">
                <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                    <i class="fa-solid fa-list text-blue-500"></i> Recent Bookings
                </h3>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b dark:border-gray-700">
                                <th class="text-left py-3 px-4 font-semibold text-sm">ID</th>
                                <th class="text-left py-3 px-4 font-semibold text-sm">Guest</th>
                                <th class="text-left py-3 px-4 font-semibold text-sm">Hotel</th>
                                <th class="text-left py-3 px-4 font-semibold text-sm">Check-in</th>
                                <th class="text-left py-3 px-4 font-semibold text-sm">Status</th>
                                <th class="text-left py-3 px-4 font-semibold text-sm">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentBookings as $booking)
                            <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                <td class="py-3 px-4 text-sm">#{{ $booking->id }}</td>
                                <td class="py-3 px-4">
                                    <div class="text-sm font-medium">{{ $booking->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $booking->guest_email }}</div>
                                </td>
                                <td class="py-3 px-4 text-sm">{{ $booking->room->hotel->name }}</td>
                                <td class="py-3 px-4 text-sm">{{ \Carbon\Carbon::parse($booking->check_in)->format('M d, Y') }}</td>
                                <td class="py-3 px-4">
                                    @php
                                    $statusColors = [
                                    'confirmed' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                    'cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                    'completed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                    ];
                                    $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm font-semibold text-green-600 dark:text-green-400">
                                    ${{ number_format($booking->total_price, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>