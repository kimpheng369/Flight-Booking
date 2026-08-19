<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function index(Request $request)
    {
        $query = Booking::with(['user', 'passenger', 'flight.airline', 'flight.originAirport', 'flight.destinationAirport']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('booking_reference', 'like', "%{$search}%")
                  ->orWhereHas('user', fn ($uq) => $uq->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('passenger', fn ($pq) => $pq->where('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%"));
        }

        if ($request->filled('status')) {
            $query->where('booking_status', $request->status);
        }

        if ($request->filled('payment')) {
            $query->where('payment_status', $request->payment);
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'passenger', 'flight.airline', 'flight.aircraft', 'flight.originAirport', 'flight.destinationAirport']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'booking_status' => 'nullable|in:Pending,Confirmed,Completed,Cancelled',
            'payment_status' => 'nullable|in:Unpaid,Paid,Refunded',
        ]);

        if ($request->booking_status === 'Cancelled' && $booking->booking_status !== 'Cancelled') {
            $this->bookingService->cancelBooking($booking);
            return back()->with('success', 'Booking cancelled and seats restored to flight inventory.');
        }

        $updates = array_filter($request->only(['booking_status', 'payment_status']));
        $booking->update($updates);

        return back()->with('success', 'Booking status updated successfully.');
    }

    public function cancel(Booking $booking)
    {
        $this->bookingService->cancelBooking($booking);
        return back()->with('success', "Booking {$booking->booking_reference} cancelled and seats restored.");
    }
}
