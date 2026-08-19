<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AirportResource;
use App\Services\AirportApiService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    protected AirportApiService $airportService;

    public function __construct(AirportApiService $airportService)
    {
        $this->airportService = $airportService;
    }

    public function index(Request $request): JsonResponse
    {
        $term = $request->get('q') ?: ($request->get('search') ?: ($request->query('q') ?: $request->query('search')));

        if (! empty($term)) {
            $airports = $this->airportService->search((string) $term);
        } else {
            $airports = $this->airportService->getAll();
        }

        return response()->json([
            'success' => true,
            'total' => $airports->count(),
            'data' => AirportResource::collection($airports),
        ]);
    }
}
