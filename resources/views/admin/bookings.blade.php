@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6">Booking Management</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Flight</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Passengers</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $booking->booking_reference }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->flight->origin }} → {{ $booking->flight->destination }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $booking->number_of_passengers }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($booking->status == 'confirmed')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Confirmed</span>
                                @elseif($booking->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Pending</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Cancelled</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($booking->status == 'pending')
                                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">Confirm</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-600">No bookings yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
