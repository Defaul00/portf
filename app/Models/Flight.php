<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline',
        'flight_number',
        'origin',
        'destination',
        'departure_time',
        'arrival_time',
        'price',
        'capacity',
        'available_seats',
        'class',
        'status',
    ];

    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];

    /**
     * Get the bookings for the flight.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
