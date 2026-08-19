<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FlightResource;
use App\Models\Flight;
use App\Services\FlightSearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    protected FlightSearchService $searchService;

    public function __construct(FlightSearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(Request $request): JsonResponse
    {
        $filters = $request->only([
            'origin', 'destination', 'departure_date', 'passengers',
            'airline_id', 'price_min', 'price_max', 'time_range', 'sort_by'
        ]);

        $flights = $this->searchService->search($filters, (int) $request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => FlightResource::collection($flights->items()),
            'pagination' => [
                'total' => $flights->total(),
                'per_page' => $flights->perPage(),
                'current_page' => $flights->currentPage(),
                'last_page' => $flights->lastPage(),
            ],
        ]);
    }

    public function show(Flight $flight): JsonResponse
    {
        $flight->load(['airline', 'aircraft', 'originAirport', 'destinationAirport']);

        return response()->json([
            'success' => true,
            'data' => new FlightResource($flight),
        ]);
    }
}
