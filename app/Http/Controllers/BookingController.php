<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with(['room.hotel'])
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    public function create(Room $room)
    {
        $room->load('hotel');
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guest_name' => 'required|string',
            'guest_email' => 'required|email',
            'guest_phone' => 'required|string',
            'guest_count' => 'required|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        $room = Room::findOrFail($validated['room_id']);

        // Check room capacity
        if ($validated['guest_count'] > $room->capacity) {
            return back()->withErrors([
                'guest_count' => "This room can only accommodate {$room->capacity} guests. Please choose a different room."
            ])->withInput();
        }

        // Check for booking overlap - CRITICAL BUSINESS LOGIC
        $isBooked = Booking::where('room_id', $validated['room_id'])
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in', [$validated['check_in'], $validated['check_out']])
                    ->orWhereBetween('check_out', [$validated['check_in'], $validated['check_out']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('check_in', '<', $validated['check_in'])
                            ->where('check_out', '>', $validated['check_out']);
                    });
            })
            ->exists();

        if ($isBooked) {
            return back()->withErrors([
                'check_in' => 'This room is already booked for the selected dates. Please choose different dates.'
            ])->withInput();
        }

        // Calculate nights and total price
        $checkIn = \Carbon\Carbon::parse($validated['check_in']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out']);
        $nights = $checkOut->diffInDays($checkIn);

        $booking = Auth::user()->bookings()->create([
            'room_id' => $room->id,
            'check_in' => $validated['check_in'],
            'check_out' => $validated['check_out'],
            'total_price' => $room->price * $nights,
            'guest_name' => $validated['guest_name'],
            'guest_email' => $validated['guest_email'],
            'guest_phone' => $validated['guest_phone'],
            'special_requests' => $validated['special_requests'] ?? null,
            'status' => 'confirmed',
            'payment_status' => 'paid',
            'payment_method' => 'credit_card',
        ]);

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully!');
    }

    public function cancel(Booking $booking)
    {
        // Check ownership
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to cancel this booking.');
        }

        // Check if booking can be cancelled
        if ($booking->status === 'cancelled') {
            return back()->with('error', 'This booking has already been cancelled.');
        }

        if ($booking->status === 'completed') {
            return back()->with('error', 'Cannot cancel a completed booking.');
        }

        // Check if check-in date has passed
        if (\Carbon\Carbon::parse($booking->check_in)->isPast()) {
            return back()->with('error', 'Cannot cancel a booking that has already started or passed.');
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }
}
