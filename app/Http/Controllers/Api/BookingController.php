<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Flight;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
        }

        $bookings = Booking::with(['flight.airline', 'flight.originAirport', 'flight.destinationAirport', 'passenger'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate((int) $request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => BookingResource::collection($bookings->items()),
            'pagination' => [
                'total' => $bookings->total(),
                'current_page' => $bookings->currentPage(),
                'last_page' => $bookings->lastPage(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
        }

        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'nullable|date',
            'passport_number' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:255',
            'seats' => 'required|integer|min:1',
        ]);

        try {
            $flight = Flight::findOrFail($validated['flight_id']);
            $seats = (int) $validated['seats'];

            $booking = $this->bookingService->createBooking($user, $flight, $validated, $seats);
            $booking->load(['flight.airline', 'flight.originAirport', 'flight.destinationAirport', 'passenger']);

            return response()->json([
                'success' => true,
                'message' => 'Booking created successfully.',
                'data' => new BookingResource($booking),
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(Request $request, Booking $booking): JsonResponse
    {
        $user = $request->user();
        if (!$user || (!$user->isAdmin() && $user->id !== $booking->user_id)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        $booking->load(['flight.airline', 'flight.originAirport', 'flight.destinationAirport', 'passenger']);

        return response()->json([
            'success' => true,
            'data' => new BookingResource($booking),
        ]);
    }

    public function destroy(Request $request, Booking $booking): JsonResponse
    {
        $user = $request->user();
        if (!$user || (!$user->isAdmin() && $user->id !== $booking->user_id)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized.'], 403);
        }

        try {
            $this->bookingService->cancelBooking($booking);

            return response()->json([
                'success' => true,
                'message' => 'Booking cancelled and seats restored.',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}
