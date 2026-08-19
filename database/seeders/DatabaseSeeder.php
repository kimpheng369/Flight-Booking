<?php

namespace Database\Seeders;

use App\Models\Aircraft;
use App\Models\Airline;
use App\Models\User;
use App\Services\RealTimeAirportApiService;
use App\Services\RealTimeFlightGeneratorService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@skybook.test'],
            [
                'name' => 'System Administrator',
                'role' => 'admin',
                'phone' => '+855 12 345 678',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Demo Customer Users
        User::updateOrCreate(
            ['email' => 'john@skybook.test'],
            [
                'name' => 'John Doe',
                'role' => 'customer',
                'phone' => '+855 92 111 222',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'jane@skybook.test'],
            [
                'name' => 'Jane Smith',
                'role' => 'customer',
                'phone' => '+65 9123 4567',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 3. Commercial Airlines
        $airlinesData = [
            ['name' => 'Cambodia Angkor Air', 'code' => 'K6', 'country' => 'Cambodia', 'logo' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?w=100&auto=format&fit=crop&q=80'],
            ['name' => 'Singapore Airlines', 'code' => 'SQ', 'country' => 'Singapore', 'logo' => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=100&auto=format&fit=crop&q=80'],
            ['name' => 'AirAsia', 'code' => 'AK', 'country' => 'Malaysia', 'logo' => 'https://images.unsplash.com/photo-1519074069444-1ba4eff56022?w=100&auto=format&fit=crop&q=80'],
            ['name' => 'Emirates', 'code' => 'EK', 'country' => 'United Arab Emirates', 'logo' => 'https://images.unsplash.com/photo-1569154941061-e231b4725ef1?w=100&auto=format&fit=crop&q=80'],
            ['name' => 'Qatar Airways', 'code' => 'QR', 'country' => 'Qatar', 'logo' => 'https://images.unsplash.com/photo-1570710891163-6d3b5c47248b?w=100&auto=format&fit=crop&q=80'],
            ['name' => 'Air France', 'code' => 'AF', 'country' => 'France', 'logo' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=100&auto=format&fit=crop&q=80'],
            ['name' => 'All Nippon Airways (ANA)', 'code' => 'NH', 'country' => 'Japan', 'logo' => 'https://images.unsplash.com/photo-1503899036084-c55cdd92da26?w=100&auto=format&fit=crop&q=80'],
        ];

        foreach ($airlinesData as $a) {
            $airline = Airline::updateOrCreate(['code' => $a['code']], $a);

            // Aircraft fleet
            Aircraft::updateOrCreate(
                ['registration_number' => 'REG-' . $a['code'] . '-01'],
                [
                    'airline_id' => $airline->id,
                    'model' => 'Airbus A320neo',
                    'seat_capacity' => 180,
                ]
            );

            Aircraft::updateOrCreate(
                ['registration_number' => 'REG-' . $a['code'] . '-02'],
                [
                    'airline_id' => $airline->id,
                    'model' => 'Boeing 787-9',
                    'seat_capacity' => 290,
                ]
            );
        }

        // 4. USE REAL TIME API SERVICE DIRECTLY (No hardcoded airport/flight seeder arrays!)
        $apiService = new RealTimeAirportApiService();
        $apiService->syncLiveAirports(250);

        $flightGenerator = new RealTimeFlightGeneratorService();
        $flightGenerator->generateLiveSchedules();
    }
}
