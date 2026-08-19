<?php

namespace App\Services;

use App\Models\Aircraft;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Carbon\Carbon;

class RealTimeFlightGeneratorService
{
    /**
     * Generate real-time live flight schedules for real airports in database.
     */
    public function generateLiveSchedules(): int
    {
        $airports = Airport::all();
        $airlines = Airline::all();
        $aircrafts = Aircraft::all();

        if ($airports->count() < 2 || $airlines->isEmpty() || $aircrafts->isEmpty()) {
            return 0;
        }

        $generatedCount = 0;
        $today = Carbon::today();

        // Generate schedules for the next 7 days
        for ($day = 0; $day < 7; $day++) {
            $currentDate = (clone $today)->addDays($day);

            // Pair hub airports with other real airports
            $hubs = $airports->whereIn('code', ['PNH', 'SAI', 'SIN', 'BKK', 'JFK', 'CDG', 'HND', 'LHR', 'DXB', 'KUL', 'LAX']);

            foreach ($hubs as $hub) {
                // Select 4 destination airports for each hub
                $destinations = $airports->where('id', '!=', $hub->id)->random(min(4, $airports->count() - 1));

                foreach ($destinations as $idx => $dest) {
                    $flightNumber = strtoupper($hub->code[0] . $dest->code[0]) . '-' . rand(100, 999);

                    // Check if flight already exists
                    if (Flight::where('flight_number', $flightNumber)->where('departure_date', $currentDate->format('Y-m-d'))->exists()) {
                        continue;
                    }

                    $airline = $airlines->random();
                    $aircraft = $aircrafts->where('airline_id', $airline->id)->first() ?? $aircrafts->random();

                    $depHour = (6 + ($idx * 3) + rand(0, 2)) % 22;
                    $depTime = sprintf('%02d:%02d:00', $depHour, rand(0, 59));
                    $durationMinutes = rand(60, 720);

                    $arrCarbon = Carbon::parse($currentDate->format('Y-m-d') . ' ' . $depTime)->addMinutes($durationMinutes);

                    Flight::create([
                        'airline_id' => $airline->id,
                        'aircraft_id' => $aircraft->id,
                        'origin_airport_id' => $hub->id,
                        'destination_airport_id' => $dest->id,
                        'flight_number' => $flightNumber,
                        'departure_date' => $currentDate->format('Y-m-d'),
                        'departure_time' => $depTime,
                        'arrival_date' => $arrCarbon->format('Y-m-d'),
                        'arrival_time' => $arrCarbon->format('H:i:s'),
                        'price' => rand(55, 850),
                        'total_seats' => $aircraft->seat_capacity,
                        'available_seats' => rand(10, $aircraft->seat_capacity - 5),
                        'baggage_allowance' => rand(0, 1) ? '30kg' : '20kg',
                        'status' => 'Scheduled',
                    ]);

                    $generatedCount++;
                }
            }
        }

        return $generatedCount;
    }
}
