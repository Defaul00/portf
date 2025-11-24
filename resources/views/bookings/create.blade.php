@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6">Flight Booking Form</h1>

    <!-- Flight Details -->
    <div class="bg-blue-50 rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Flight Details</h2>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-600">Airline</p>
                <p class="font-bold">{{ $flight->airline }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Flight Number</p>
                <p class="font-bold">{{ $flight->flight_number }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Route</p>
                <p class="font-bold">{{ $flight->origin }} → {{ $flight->destination }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Class</p>
                <p class="font-bold capitalize">{{ $flight->class }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Departure Date & Time</p>
                <p class="font-bold">{{ \Carbon\Carbon::parse($flight->departure_time)->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Arrival Time</p>
                <p class="font-bold">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('d M Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Price per Ticket</p>
                <p class="font-bold text-blue-600">Rp {{ number_format($flight->price, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600">Available Seats</p>
                <p class="font-bold">{{ $flight->available_seats }}</p>
            </div>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-6">Passenger Information</h2>
        <form action="{{ route('bookings.store', $flight->id) }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="passenger_name" required value="{{ old('passenger_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Full passenger name">
                    @error('passenger_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="passenger_email" required value="{{ old('passenger_email', Auth::user()->email) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="email@example.com">
                    @error('passenger_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                    <input type="text" name="passenger_phone" required value="{{ old('passenger_phone') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="081234567890">
                    @error('passenger_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Number of Passengers *</label>
                    <input type="number" name="number_of_passengers" required min="1" max="{{ $flight->available_seats }}" value="{{ old('number_of_passengers', 1) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('number_of_passengers')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maximum {{ $flight->available_seats }} seats available</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-md">
                    <p class="text-sm text-gray-600 mb-2">Total Payment</p>
                    <p class="text-2xl font-bold text-green-600">Rp {{ number_format($flight->price, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500 mt-1">* Price may change based on number of passengers</p>
                </div>

                <div class="flex gap-4">
                    <a href="{{ route('flights.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white text-center px-6 py-2 rounded-md font-medium transition">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition">
                        Confirm Booking
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
