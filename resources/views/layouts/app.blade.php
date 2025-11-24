<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('AirBook', default: 'AirBook') }} - Flight Booking System</title>
    <link rel="shortcut icon" href="" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div id="app" class="min-h-screen flex flex-col">
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('flights.index') }}" class="text-2xl font-bold text-blue-600">
                                ✈️ AirBook
                            </a>
                        </div>
                        <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                            <a href="{{ route('flights.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                Search Flights
                            </a>
                            @auth
                                <a href="{{ route('bookings.index') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                    My Bookings
                                </a>
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                                        Admin Dashboard
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:items-center">
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="ml-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">Register</a>
                        @else
                            <a href="{{ route('chat.index') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                                💬 AI Chat
                            </a>
                            <div class="ml-3 relative">
                                <div class="flex items-center">
                                    <span class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                                    <form method="POST" action="{{ route('logout') }}" class="ml-3">
                                        @csrf
                                        <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">Logout</button>
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 py-6 pb-12">
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="bg-gray-800 text-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-lg font-bold mb-4">AirBook</h3>
                        <p class="text-gray-400">Trusted platform for flight booking with the best service.</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-4">Contact</h3>
                        <p class="text-gray-400">Email: info@airbook.com</p>
                        <p class="text-gray-400">Phone: 0800-1234-5678</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold mb-4">Features</h3>
                        <ul class="text-gray-400 space-y-2">
                            <li>Flight Booking</li>
                            <li>AI Chat Assistant</li>
                            <li>Booking Management</li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} AirBook. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
