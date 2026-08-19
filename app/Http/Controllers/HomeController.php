<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Flight;

class HomeController extends Controller
{
    public function index()
    {
        $airports = Airport::orderBy('city')->get();
        $airlines = Airline::orderBy('name')->get();

        $featuredFlights = Flight::with(['airline', 'originAirport', 'destinationAirport'])
            ->where('status', 'Scheduled')
            ->where('available_seats', '>', 0)
            ->whereDate('departure_date', '>=', now())
            ->orderBy('price', 'asc')
            ->take(6)
            ->get();

        $stats = [
            'total_flights' => Flight::count(),
            'total_bookings' => Booking::count(),
            'airports_count' => Airport::count(),
            'airlines_count' => Airline::count(),
        ];

        return view('home', compact('airports', 'airlines', 'featuredFlights', 'stats'));
    }
}
