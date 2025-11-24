@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold mb-6">User Management</h1>

    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->phone ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->role == 'admin')
                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs">Admin</span>
                                @else
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">User</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-600">No users found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
