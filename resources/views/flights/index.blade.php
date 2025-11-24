@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-4xl font-bold mb-4">Find Your Flight</h1>
        <p class="text-xl">Discover the best flights at the best prices</p>
    </div>

    <!-- Search Form -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-2xl font-bold mb-6">Flight Search</h2>
        <form action="{{ route('flights.search') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">From</label>
                <input type="text" name="origin" value="{{ request('origin') }}" placeholder="Jakarta" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">To</label>
                <input type="text" name="destination" value="{{ request('destination') }}" placeholder="Bali" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                <input type="date" name="departure_date" value="{{ request('departure_date') }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Class</label>
                <select name="class" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">All Classes</option>
                    <option value="economy" {{ request('class') == 'economy' ? 'selected' : '' }}>Economy</option>
                    <option value="business" {{ request('class') == 'business' ? 'selected' : '' }}>Business</option>
                    <option value="first" {{ request('class') == 'first' ? 'selected' : '' }}>First Class</option>
                </select>
            </div>
            <div class="md:col-span-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium">
                    Search Flights
                </button>
            </div>
        </form>
    </div>

    <!-- Flights List -->
    <div class="space-y-4">
        <h2 class="text-2xl font-bold mb-4">Available Flights</h2>
        
        @if($flights->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">No flights found.</strong>
                <span class="block sm:inline"> Please try different search criteria.</span>
            </div>
        @else
            @foreach($flights as $flight)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                        <div class="md:col-span-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $flight->airline }}</h3>
                            <p class="text-sm text-gray-600">{{ $flight->flight_number }}</p>
                            <p class="text-sm text-gray-600">Class: <span class="font-semibold capitalize">{{ $flight->class }}</span></p>
                        </div>
                        <div class="md:col-span-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-600">Departure</p>
                                    <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</p>
                                    <p class="text-sm text-gray-600">{{ $flight->origin }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">Arrival</p>
                                    <p class="text-lg font-bold">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</p>
                                    <p class="text-sm text-gray-600">{{ $flight->destination }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($flight->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-600">per person</p>
                            <p class="text-sm text-gray-600">{{ $flight->available_seats }} seats available</p>
                        </div>
                        <div class="md:col-span-2">
                            @auth
                                @if($flight->available_seats > 0)
                                    <a href="{{ route('bookings.create', $flight->id) }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-2 rounded-md font-medium transition">
                                        Select
                                    </a>
                                @else
                                    <button disabled class="block w-full bg-gray-400 text-white text-center px-4 py-2 rounded-md font-medium cursor-not-allowed">
                                        Sold Out
                                    </button>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full bg-green-600 hover:bg-green-700 text-white text-center px-4 py-2 rounded-md font-medium transition">
                                    Login to Book
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
