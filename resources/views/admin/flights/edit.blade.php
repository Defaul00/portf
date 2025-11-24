@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Edit Flight</h1>
        <a href="{{ route('admin.flights') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-md font-medium">
            ← Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.flights.update', $flight->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="airline" class="block text-sm font-medium text-gray-700 mb-2">Airline *</label>
                    <input type="text" 
                           id="airline" 
                           name="airline" 
                           value="{{ old('airline', $flight->airline) }}" 
                           required
                           placeholder="Example: Garuda Indonesia"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('airline')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="flight_number" class="block text-sm font-medium text-gray-700 mb-2">Flight Number *</label>
                    <input type="text" 
                           id="flight_number" 
                           name="flight_number" 
                           value="{{ old('flight_number', $flight->flight_number) }}" 
                           required
                           placeholder="Example: GA123"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('flight_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="origin" class="block text-sm font-medium text-gray-700 mb-2">Origin *</label>
                    <input type="text" 
                           id="origin" 
                           name="origin" 
                           value="{{ old('origin', $flight->origin) }}" 
                           required
                           placeholder="Example: Jakarta"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('origin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="destination" class="block text-sm font-medium text-gray-700 mb-2">Destination *</label>
                    <input type="text" 
                           id="destination" 
                           name="destination" 
                           value="{{ old('destination', $flight->destination) }}" 
                           required
                           placeholder="Example: Bali"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('destination')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="departure_time" class="block text-sm font-medium text-gray-700 mb-2">Departure Time *</label>
                    <input type="datetime-local" 
                           id="departure_time" 
                           name="departure_time" 
                           value="{{ old('departure_time', \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d\TH:i')) }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('departure_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="arrival_time" class="block text-sm font-medium text-gray-700 mb-2">Arrival Time *</label>
                    <input type="datetime-local" 
                           id="arrival_time" 
                           name="arrival_time" 
                           value="{{ old('arrival_time', \Carbon\Carbon::parse($flight->arrival_time)->format('Y-m-d\TH:i')) }}" 
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('arrival_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (Rp) *</label>
                    <input type="number" 
                           id="price" 
                           name="price" 
                           value="{{ old('price', $flight->price) }}" 
                           required
                           min="0"
                           step="1000"
                           placeholder="2500000"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="capacity" class="block text-sm font-medium text-gray-700 mb-2">Seat Capacity *</label>
                    <input type="number" 
                           id="capacity" 
                           name="capacity" 
                           value="{{ old('capacity', $flight->capacity) }}" 
                           required
                           min="1"
                           placeholder="150"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('capacity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="class" class="block text-sm font-medium text-gray-700 mb-2">Class *</label>
                    <select id="class" 
                            name="class" 
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Select Class</option>
                        <option value="economy" {{ old('class', $flight->class) == 'economy' ? 'selected' : '' }}>Economy</option>
                        <option value="business" {{ old('class', $flight->class) == 'business' ? 'selected' : '' }}>Business</option>
                        <option value="first" {{ old('class', $flight->class) == 'first' ? 'selected' : '' }}>First Class</option>
                    </select>
                    @error('class')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" 
                            name="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="1" {{ old('status', $flight->status) == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $flight->status) == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-4 pt-6">
                <a href="{{ route('admin.flights') }}" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white text-center px-6 py-3 rounded-md font-medium transition">
                    Cancel
                </a>
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md font-medium transition">
                    Update Flight
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

