@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Flights</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total_flights'] }}</p>
                </div>
                <div class="text-4xl">✈️</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Active Flights</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['active_flights'] }}</p>
                </div>
                <div class="text-4xl">✅</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Bookings</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['total_bookings'] }}</p>
                </div>
                <div class="text-4xl">📋</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pending Bookings</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_bookings'] }}</p>
                </div>
                <div class="text-4xl">⏳</div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Recent Bookings</h2>
        
        @if($stats['recent_bookings']->isEmpty())
            <p class="text-gray-600">No bookings yet</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Flight</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($stats['recent_bookings'] as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $booking->booking_reference }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->flight->origin }} → {{ $booking->flight->destination }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($booking->status == 'confirmed')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Confirmed</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">Pending</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="{{ route('admin.flights') }}" class="bg-blue-600 hover:bg-blue-700 text-white p-6 rounded-lg shadow-md text-center font-medium">
            Manage Flights
        </a>
        <a href="{{ route('admin.bookings') }}" class="bg-green-600 hover:bg-green-700 text-white p-6 rounded-lg shadow-md text-center font-medium">
            Manage Bookings
        </a>
        <a href="{{ route('admin.users') }}" class="bg-purple-600 hover:bg-purple-700 text-white p-6 rounded-lg shadow-md text-center font-medium">
            Manage Users
        </a>
    </div>
</div>
@endsection
