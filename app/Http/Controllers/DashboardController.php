<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $totalBookings = Booking::where('user_id', $user->id)->count();
        $upcomingCount = Booking::where('user_id', $user->id)
            ->where('booking_status', 'Confirmed')
            ->whereHas('flight', function ($q) {
                $q->whereDate('departure_date', '>=', now());
            })->count();

        $completedCount = Booking::where('user_id', $user->id)
            ->where(function ($q) {
                $q->where('booking_status', 'Completed')
                  ->orWhereHas('flight', function ($fq) {
                      $fq->whereDate('departure_date', '<', now());
                  });
            })->where('booking_status', '!=', 'Cancelled')->count();

        $cancelledCount = Booking::where('user_id', $user->id)
            ->where('booking_status', 'Cancelled')->count();

        $recentBookings = Booking::with(['flight.airline', 'flight.originAirport', 'flight.destinationAirport', 'passenger'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $upcomingFlights = Booking::with(['flight.airline', 'flight.originAirport', 'flight.destinationAirport', 'passenger'])
            ->where('user_id', $user->id)
            ->where('booking_status', 'Confirmed')
            ->whereHas('flight', function ($q) {
                $q->whereDate('departure_date', '>=', now());
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'user', 'totalBookings', 'upcomingCount',
            'completedCount', 'cancelledCount', 'recentBookings', 'upcomingFlights'
        ));
    }
}
