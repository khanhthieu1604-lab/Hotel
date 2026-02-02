<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total_bookings' => $user->bookings()->count(),
            'upcoming_stays' => $user->bookings()
                ->where('status', 'confirmed')
                ->where('check_in', '>=', now())
                ->count(),
            'total_spent' => $user->bookings()
                ->where('payment_status', 'paid')
                ->sum('total_price'),
        ];

        $upcomingBookings = $user->bookings()
            ->with(['room.hotel'])
            ->where('check_in', '>=', now())
            ->orderBy('check_in')
            ->take(3)
            ->get();

        $recentBookings = $user->bookings()
            ->with(['room.hotel'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'upcomingBookings', 'recentBookings'));
    }
}
