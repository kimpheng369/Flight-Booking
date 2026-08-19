<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    public function index(Request $request)
    {
        $query = Airport::withCount(['departingFlights', 'arrivingFlights']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
        }

        $airports = $query->orderBy('city')->paginate(10)->withQueryString();

        return view('admin.airports.index', compact('airports'));
    }

    public function create()
    {
        return view('admin.airports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:airports,code',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'timezone' => 'required|string|max:100',
        ]);

        Airport::create($validated);

        return redirect()->route('admin.airports.index')->with('success', 'Airport added successfully.');
    }

    public function edit(Airport $airport)
    {
        return view('admin.airports.edit', compact('airport'));
    }

    public function update(Request $request, Airport $airport)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|size:3|unique:airports,code,' . $airport->id,
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'timezone' => 'required|string|max:100',
        ]);

        $airport->update($validated);

        return redirect()->route('admin.airports.index')->with('success', 'Airport details updated.');
    }

    public function destroy(Airport $airport)
    {
        if ($airport->departingFlights()->exists() || $airport->arrivingFlights()->exists()) {
            return back()->with('error', 'Cannot delete airport associated with flights.');
        }

        $airport->delete();

        return redirect()->route('admin.airports.index')->with('success', 'Airport deleted.');
    }
}
