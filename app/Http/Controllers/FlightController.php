<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use App\Services\BookingService;
use App\Services\FlightSearchService;
use Illuminate\Http\Request;
use Exception;

class FlightController extends Controller
{
    protected FlightSearchService $searchService;
    protected BookingService $bookingService;

    public function __construct(FlightSearchService $searchService, BookingService $bookingService)
    {
        $this->searchService = $searchService;
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'origin', 'destination', 'departure_date', 'passengers',
            'airline_id', 'price_min', 'price_max', 'time_range', 'sort_by'
        ]);

        $flights = $this->searchService->search($filters, 9);
        $airports = Airport::orderBy('city')->get();
        $airlines = Airline::orderBy('name')->get();

        return view('flights.index', compact('flights', 'airports', 'airlines', 'filters'));
    }

    public function show(Flight $flight)
    {
        $flight->load(['airline', 'aircraft', 'originAirport', 'destinationAirport']);
        return view('flights.show', compact('flight'));
    }

    public function book(Flight $flight, Request $request)
    {
        $seats = (int) $request->query('passengers', 1);

        if (!$this->bookingService->checkAvailability($flight, $seats)) {
            return redirect()->route('flights.show', $flight)
                ->with('error', 'Sorry, this flight does not have enough available seats.');
        }

        $totalPrice = $this->bookingService->calculateTotal($flight, $seats);
        $flight->load(['airline', 'aircraft', 'originAirport', 'destinationAirport']);

        return view('flights.book', compact('flight', 'seats', 'totalPrice'));
    }

    public function storeBooking(StoreBookingRequest $request, Flight $flight)
    {
        try {
            $user = $request->user();
            $seats = (int) $request->input('seats', 1);

            $passengerData = $request->only([
                'first_name', 'last_name', 'gender', 'date_of_birth',
                'passport_number', 'phone', 'email'
            ]);

            $booking = $this->bookingService->createBooking($user, $flight, $passengerData, $seats);

            return redirect()->route('bookings.show', $booking)
                ->with('success', "Booking confirmed successfully! Your reference is {$booking->booking_reference}");
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
}
