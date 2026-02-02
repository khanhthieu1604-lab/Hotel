<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Hotel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
            'total_hotels' => Hotel::count(),
        ];

        $recentBookings = Booking::with(['user', 'room.hotel'])
            ->latest()
            ->take(10)
            ->get();

        // Last 7 days data for charts
        $last7Days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $last7Days->push([
                'date' => now()->subDays($i)->format('M d'),
                'bookings' => Booking::whereDate('created_at', $date)->count(),
                'revenue' => Booking::whereDate('created_at', $date)
                    ->where('payment_status', 'paid')
                    ->sum('total_price'),
            ]);
        }

        return view('admin.dashboard', compact('stats', 'recentBookings', 'last7Days'));
    }
}
