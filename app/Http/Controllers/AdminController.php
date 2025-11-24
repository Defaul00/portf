<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->isAdmin()) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_flights' => Flight::count(),
            'active_flights' => Flight::where('status', true)->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'total_users' => User::count(),
            'recent_bookings' => Booking::with(['flight', 'user'])->latest()->take(10)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Show flights management
     */
    public function flights()
    {
        $flights = Flight::latest()->get();
        return view('admin.flights', compact('flights'));
    }

    /**
     * Show bookings management
     */
    public function bookings()
    {
        $bookings = Booking::with(['flight', 'user'])->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Show users management
     */
    public function users()
    {
        $users = User::latest()->get();
        return view('admin.users', compact('users'));
    }
}
