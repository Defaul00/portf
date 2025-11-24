<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flight;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights = [
            [
                'airline' => 'Garuda Indonesia',
                'flight_number' => 'GA123',
                'origin' => 'Jakarta',
                'destination' => 'Bali',
                'departure_time' => now()->addDays(7)->setTime(8, 0),
                'arrival_time' => now()->addDays(7)->setTime(11, 0),
                'price' => 2500000,
                'capacity' => 150,
                'available_seats' => 150,
                'class' => 'economy',
                'status' => true,
            ],
            [
                'airline' => 'Lion Air',
                'flight_number' => 'JT456',
                'origin' => 'Jakarta',
                'destination' => 'Surabaya',
                'departure_time' => now()->addDays(5)->setTime(10, 0),
                'arrival_time' => now()->addDays(5)->setTime(11, 30),
                'price' => 1500000,
                'capacity' => 180,
                'available_seats' => 180,
                'class' => 'economy',
                'status' => true,
            ],
            [
                'airline' => 'AirAsia',
                'flight_number' => 'QZ789',
                'origin' => 'Jakarta',
                'destination' => 'Medan',
                'departure_time' => now()->addDays(10)->setTime(14, 0),
                'arrival_time' => now()->addDays(10)->setTime(16, 30),
                'price' => 1800000,
                'capacity' => 180,
                'available_seats' => 180,
                'class' => 'economy',
                'status' => true,
            ],
            [
                'airline' => 'Sriwijaya Air',
                'flight_number' => 'SJ234',
                'origin' => 'Jakarta',
                'destination' => 'Bandung',
                'departure_time' => now()->addDays(3)->setTime(9, 0),
                'arrival_time' => now()->addDays(3)->setTime(9, 45),
                'price' => 800000,
                'capacity' => 150,
                'available_seats' => 150,
                'class' => 'economy',
                'status' => true,
            ],
            [
                'airline' => 'Citilink',
                'flight_number' => 'QG567',
                'origin' => 'Jakarta',
                'destination' => 'Yogyakarta',
                'departure_time' => now()->addDays(6)->setTime(11, 0),
                'arrival_time' => now()->addDays(6)->setTime(12, 15),
                'price' => 1200000,
                'capacity' => 180,
                'available_seats' => 180,
                'class' => 'economy',
                'status' => true,
            ],
            [
                'airline' => 'Garuda Indonesia',
                'flight_number' => 'GA890',
                'origin' => 'Jakarta',
                'destination' => 'Bali',
                'departure_time' => now()->addDays(7)->setTime(14, 0),
                'arrival_time' => now()->addDays(7)->setTime(17, 0),
                'price' => 3500000,
                'capacity' => 50,
                'available_seats' => 50,
                'class' => 'business',
                'status' => true,
            ],
            [
                'airline' => 'Lion Air',
                'flight_number' => 'JT123',
                'origin' => 'Bali',
                'destination' => 'Jakarta',
                'departure_time' => now()->addDays(8)->setTime(12, 0),
                'arrival_time' => now()->addDays(8)->setTime(15, 0),
                'price' => 2500000,
                'capacity' => 180,
                'available_seats' => 180,
                'class' => 'economy',
                'status' => true,
            ],
            [
                'airline' => 'AirAsia',
                'flight_number' => 'QZ456',
                'origin' => 'Surabaya',
                'destination' => 'Jakarta',
                'departure_time' => now()->addDays(6)->setTime(16, 0),
                'arrival_time' => now()->addDays(6)->setTime(17, 30),
                'price' => 1500000,
                'capacity' => 180,
                'available_seats' => 180,
                'class' => 'economy',
                'status' => true,
            ],
        ];

        foreach ($flights as $flight) {
            Flight::create($flight);
        }
    }
}
