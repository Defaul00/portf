<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Auth::user()->bookings()->with('flight')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($flightId)
    {
        $flight = Flight::findOrFail($flightId);
        return view('bookings.create', compact('flight'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $flightId)
    {
        $flight = Flight::findOrFail($flightId);

        $validated = $request->validate([
            'passenger_name' => 'required|string|max:255',
            'passenger_email' => 'required|email',
            'passenger_phone' => 'required|string',
            'number_of_passengers' => 'required|integer|min:1|max:' . $flight->available_seats,
        ]);

        $totalPrice = $flight->price * $validated['number_of_passengers'];
        
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'flight_id' => $flightId,
            'booking_reference' => 'BK' . strtoupper(Str::random(8)),
            'passenger_name' => $validated['passenger_name'],
            'passenger_email' => $validated['passenger_email'],
            'passenger_phone' => $validated['passenger_phone'],
            'number_of_passengers' => $validated['number_of_passengers'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Update available seats
        $flight->decrement('available_seats', $validated['number_of_passengers']);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully. Reference: ' . $booking->booking_reference);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($validated);

        return redirect()->route('admin.bookings')->with('success', 'Booking status updated successfully');
    }

    /**
     * Cancel booking
     */
    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->update(['status' => 'cancelled']);
        
        // Restore seats
        $booking->flight->increment('available_seats', $booking->number_of_passengers);

        return redirect()->route('bookings.index')->with('success', 'Booking cancelled successfully');
    }
}
