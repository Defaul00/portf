@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Flight Management</h1>
        <div class="flex gap-2">
            <a href="{{ route('flights.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium">
                View as User
            </a>
            <a href="{{ route('admin.flights.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-medium">
                + Add Flight
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Airline</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Route</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Departure</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Seats</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($flights as $flight)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $flight->airline }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $flight->origin }} → {{ $flight->destination }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($flight->departure_time)->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($flight->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $flight->available_seats }}/{{ $flight->capacity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($flight->status)
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Active</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                <a href="{{ route('admin.flights.edit', $flight->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">Edit</a>
                                <form action="{{ route('admin.flights.destroy', $flight->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this flight?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-600">No flight data available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
