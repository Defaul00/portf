<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return redirect()->route('flights.index');
});

Auth::routes();

// Redirect home to appropriate dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Public routes
Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');
Route::post('/flights/search', [FlightController::class, 'search'])->name('flights.search');

// Authenticated user routes
Route::middleware('auth')->group(function () {
    // Flight booking
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{flight}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/store/{flight}', [BookingController::class, 'store'])->name('bookings.store');
    Route::post('/bookings/cancel/{booking}', [BookingController::class, 'cancel'])->name('bookings.cancel');
    
    // Chat AI
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    
    // Admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/flights', [AdminController::class, 'flights'])->name('admin.flights');
        Route::get('/bookings', [AdminController::class, 'bookings'])->name('admin.bookings');
        Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
        
        // Flight management
        Route::get('/flights/create', [FlightController::class, 'create'])->name('admin.flights.create');
        Route::post('/flights', [FlightController::class, 'store'])->name('admin.flights.store');
        Route::get('/flights/{flight}/edit', [FlightController::class, 'edit'])->name('admin.flights.edit');
        Route::put('/flights/{flight}', [FlightController::class, 'update'])->name('admin.flights.update');
        Route::delete('/flights/{flight}', [FlightController::class, 'destroy'])->name('admin.flights.destroy');
        
        // Booking management
        Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('admin.bookings.update');
    });
});
