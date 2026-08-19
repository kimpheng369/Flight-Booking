<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use Illuminate\Http\Request;

class AirlineController extends Controller
{
    public function index(Request $request)
    {
        $query = Airline::withCount(['flights', 'aircraft']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%")
                  ->orWhere('country', 'like', "%{$search}%");
        }

        $airlines = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('admin.airlines.index', compact('airlines'));
    }

    public function create()
    {
        return view('admin.airlines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:5|unique:airlines,code',
            'country' => 'required|string|max:255',
            'logo' => 'nullable|url|max:500',
        ]);

        Airline::create($validated);

        return redirect()->route('admin.airlines.index')->with('success', 'Airline created successfully.');
    }

    public function edit(Airline $airline)
    {
        return view('admin.airlines.edit', compact('airline'));
    }

    public function update(Request $request, Airline $airline)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:5|unique:airlines,code,' . $airline->id,
            'country' => 'required|string|max:255',
            'logo' => 'nullable|url|max:500',
        ]);

        $airline->update($validated);

        return redirect()->route('admin.airlines.index')->with('success', 'Airline updated successfully.');
    }

    public function destroy(Airline $airline)
    {
        if ($airline->flights()->exists()) {
            return back()->with('error', 'Cannot delete airline with scheduled flights.');
        }

        $airline->delete();

        return redirect()->route('admin.airlines.index')->with('success', 'Airline deleted successfully.');
    }
}
