<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFlightRequest;
use App\Http\Requests\UpdateFlightRequest;
use App\Models\Aircraft;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function index(Request $request)
    {
        $query = Flight::with(['airline', 'aircraft', 'originAirport', 'destinationAirport']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('flight_number', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('airline_id')) {
            $query->where('airline_id', $request->airline_id);
        }

        $flights = $query->orderBy('departure_date', 'desc')->paginate(10)->withQueryString();
        $airlines = Airline::orderBy('name')->get();

        return view('admin.flights.index', compact('flights', 'airlines'));
    }

    public function create()
    {
        $airlines = Airline::orderBy('name')->get();
        $airports = Airport::orderBy('city')->get();
        $aircrafts = Aircraft::with('airline')->orderBy('model')->get();

        return view('admin.flights.create', compact('airlines', 'airports', 'aircrafts'));
    }

    public function store(StoreFlightRequest $request)
    {
        Flight::create($request->validated());

        return redirect()->route('admin.flights.index')->with('success', 'Flight created successfully.');
    }

    public function show(Flight $flight)
    {
        $flight->load(['airline', 'aircraft', 'originAirport', 'destinationAirport', 'bookings.user']);
        return view('admin.flights.show', compact('flight'));
    }

    public function edit(Flight $flight)
    {
        $airlines = Airline::orderBy('name')->get();
        $airports = Airport::orderBy('city')->get();
        $aircrafts = Aircraft::with('airline')->orderBy('model')->get();

        return view('admin.flights.edit', compact('flight', 'airlines', 'airports', 'aircrafts'));
    }

    public function update(UpdateFlightRequest $request, Flight $flight)
    {
        $flight->update($request->validated());

        return redirect()->route('admin.flights.index')->with('success', 'Flight updated successfully.');
    }

    public function destroy(Flight $flight)
    {
        if ($flight->bookings()->exists()) {
            return back()->with('error', 'Cannot delete flight that has active bookings.');
        }

        $flight->delete();

        return redirect()->route('admin.flights.index')->with('success', 'Flight deleted successfully.');
    }
}
