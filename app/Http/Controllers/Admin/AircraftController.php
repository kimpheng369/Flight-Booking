<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aircraft;
use App\Models\Airline;
use Illuminate\Http\Request;

class AircraftController extends Controller
{
    public function index(Request $request)
    {
        $query = Aircraft::with('airline');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('model', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%");
        }

        $aircrafts = $query->orderBy('model')->paginate(10)->withQueryString();

        return view('admin.aircraft.index', compact('aircrafts'));
    }

    public function create()
    {
        $airlines = Airline::orderBy('name')->get();
        return view('admin.aircraft.create', compact('airlines'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'model' => 'required|string|max:255',
            'registration_number' => 'required|string|max:50|unique:aircraft,registration_number',
            'seat_capacity' => 'required|integer|min:1',
        ]);

        Aircraft::create($validated);

        return redirect()->route('admin.aircraft.index')->with('success', 'Aircraft registered successfully.');
    }

    public function edit(Aircraft $aircraft)
    {
        $airlines = Airline::orderBy('name')->get();
        return view('admin.aircraft.edit', compact('aircraft', 'airlines'));
    }

    public function update(Request $request, Aircraft $aircraft)
    {
        $validated = $request->validate([
            'airline_id' => 'required|exists:airlines,id',
            'model' => 'required|string|max:255',
            'registration_number' => 'required|string|max:50|unique:aircraft,registration_number,' . $aircraft->id,
            'seat_capacity' => 'required|integer|min:1',
        ]);

        $aircraft->update($validated);

        return redirect()->route('admin.aircraft.index')->with('success', 'Aircraft updated successfully.');
    }

    public function destroy(Aircraft $aircraft)
    {
        if ($aircraft->flights()->exists()) {
            return back()->with('error', 'Cannot delete aircraft assigned to active flights.');
        }

        $aircraft->delete();

        return redirect()->route('admin.aircraft.index')->with('success', 'Aircraft removed.');
    }
}
