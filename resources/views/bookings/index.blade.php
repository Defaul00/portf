@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6">My Bookings</h1>

    @if($bookings->isEmpty())
        <div class="bg-gray-50 rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-600 text-lg mb-4">No bookings yet.</p>
            <a href="{{ route('flights.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium">
                Search Flights
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($bookings as $booking)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-blue-600">{{ $booking->booking_reference }}</h3>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            @if($booking->status == 'confirmed')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Confirmed</span>
                            @elseif($booking->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Cancelled</span>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Airline</p>
                            <p class="font-bold">{{ $booking->flight->airline }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Route</p>
                            <p class="font-bold">{{ $booking->flight->origin }} → {{ $booking->flight->destination }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Date & Time</p>
                            <p class="font-bold">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Passengers</p>
                            <p class="font-bold">{{ $booking->number_of_passengers }} person(s)</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Passenger Name</p>
                            <p class="font-bold">{{ $booking->passenger_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email</p>
                            <p class="font-bold">{{ $booking->passenger_email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Payment</p>
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    @if($booking->status == 'pending')
                        <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md font-medium">
                                Cancel Booking
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
