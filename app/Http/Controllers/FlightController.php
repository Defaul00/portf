<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flights = Flight::where('status', true)->latest()->get();
        return view('flights.index', compact('flights'));
    }

    /**
     * Search flights
     */
    public function search(Request $request)
    {
        $query = Flight::where('status', true);

        if ($request->origin) {
            $query->where('origin', 'like', '%' . $request->origin . '%');
        }

        if ($request->destination) {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }

        if ($request->departure_date) {
            $query->whereDate('departure_time', $request->departure_date);
        }

        if ($request->class) {
            $query->where('class', $request->class);
        }

        $flights = $query->latest()->get();
        return view('flights.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.flights.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flight $flight)
    {
        return view('admin.flights.show', compact('flight'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'class' => 'required|in:economy,business,first',
        ]);

        $validated['available_seats'] = $validated['capacity'];
        
        Flight::create($validated);

        return redirect()->route('admin.flights')->with('success', 'Flight created successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
            'class' => 'required|in:economy,business,first',
            'status' => 'boolean',
        ]);

        $flight->update($validated);

        return redirect()->route('admin.flights')->with('success', 'Flight updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()->route('admin.flights')->with('success', 'Flight deleted successfully');
    }
}
