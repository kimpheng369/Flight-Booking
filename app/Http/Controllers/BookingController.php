<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Exception;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $query = Booking::with(['flight.airline', 'flight.originAirport', 'flight.destinationAirport', 'passenger'])
            ->where('user_id', $user->id);

        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                  ->orWhereHas('flight', function ($fq) use ($search) {
                      $fq->where('flight_number', 'like', "%{$search}%");
                  });
            });
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);

        $booking->load(['user', 'passenger', 'flight.airline', 'flight.aircraft', 'flight.originAirport', 'flight.destinationAirport']);

        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        $this->authorize('cancel', $booking);

        try {
            $this->bookingService->cancelBooking($booking);
            return back()->with('success', "Booking {$booking->booking_reference} has been cancelled and seats restored.");
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
