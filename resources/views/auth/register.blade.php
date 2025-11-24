<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Register') }} - AirBook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo & Title -->
            <div class="text-center">
                <h1 class="text-5xl mb-2">✈️</h1>
                <h2 class="text-4xl font-bold text-white mb-2">AirBook</h2>
                <p class="text-white text-lg">Join Us Today</p>
            </div>

            <!-- Register Form -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Create Account</h3>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h4 class="text-sm font-semibold text-blue-800 mb-2">Choose Role:</h4>
                    <ul class="text-xs text-blue-700 space-y-1">
                        <li><strong>User (Customer):</strong> For booking flights</li>
                        <li><strong>Admin:</strong> For managing system and data</li>
                    </ul>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input id="name" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autocomplete="name" 
                               autofocus
                               placeholder="Enter your full name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input id="email" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               placeholder="name@email.com"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input id="phone" 
                               type="text" 
                               name="phone" 
                               value="{{ old('phone') }}" 
                               autocomplete="tel"
                               placeholder="081234567890"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="role" 
                                name="role" 
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="">Select Role</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Customer)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">Choose role according to your needs</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" 
                               type="password" 
                               name="password" 
                               required 
                               autocomplete="new-password"
                               placeholder="Minimum 8 characters"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input id="password-confirm" 
                               type="password" 
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="Re-enter password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg font-semibold text-lg transition duration-300 transform hover:scale-105 shadow-lg mt-6">
                        Register
                    </button>

                    <div class="text-center text-sm text-gray-600">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Login here
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
