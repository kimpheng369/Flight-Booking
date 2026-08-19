<?php

namespace Tests\Feature;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FlightSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_flight_search_filters_by_origin_and_destination_database_queries(): void
    {
        $origin = Airport::factory()->create(['code' => 'PNH', 'city' => 'Phnom Penh']);
        $destination = Airport::factory()->create(['code' => 'BKK', 'city' => 'Bangkok']);
        $airline = Airline::factory()->create();

        $matchingFlight = Flight::factory()->create([
            'airline_id' => $airline->id,
            'origin_airport_id' => $origin->id,
            'destination_airport_id' => $destination->id,
            'flight_number' => 'SK-888',
            'available_seats' => 50,
            'status' => 'Scheduled',
        ]);

        $otherFlight = Flight::factory()->create([
            'status' => 'Scheduled',
        ]);

        $response = $this->get('/flights?origin=PNH&destination=BKK');

        $response->assertStatus(200);
        $response->assertSee('SK-888');
    }
}
