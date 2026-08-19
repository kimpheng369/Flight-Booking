<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Airport;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalFlights = Flight::count();
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('booking_status', 'Confirmed')->count();
        $cancelledBookings = Booking::where('booking_status', 'Cancelled')->count();
        $totalRevenue = Booking::where('payment_status', 'Paid')->sum('total_price');

        // Chart 1: Bookings per month (last 6 months)
        $months = collect();
        $monthlyBookingsData = collect();
        $monthlyRevenueData = collect();

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabel = $date->format('M Y');
            $months->push($monthLabel);

            $count = Booking::whereYear('booked_at', $date->year)
                ->whereMonth('booked_at', $date->month)
                ->count();
            $monthlyBookingsData->push($count);

            $revenue = Booking::whereYear('booked_at', $date->year)
                ->whereMonth('booked_at', $date->month)
                ->where('payment_status', 'Paid')
                ->sum('total_price');
            $monthlyRevenueData->push((float) $revenue);
        }

        // Chart 3: Popular Destinations
        $popularDestinations = Flight::join('airports', 'flights.destination_airport_id', '=', 'airports.id')
            ->join('bookings', 'flights.id', '=', 'bookings.flight_id')
            ->select('airports.city', DB::raw('count(bookings.id) as booking_count'))
            ->groupBy('airports.city')
            ->orderByDesc('booking_count')
            ->take(5)
            ->get();

        // Chart 4: Booking Status Distribution
        $statusDistribution = [
            'Confirmed' => Booking::where('booking_status', 'Confirmed')->count(),
            'Completed' => Booking::where('booking_status', 'Completed')->count(),
            'Pending' => Booking::where('booking_status', 'Pending')->count(),
            'Cancelled' => Booking::where('booking_status', 'Cancelled')->count(),
        ];

        $recentBookings = Booking::with(['user', 'flight.airline', 'flight.originAirport', 'flight.destinationAirport'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers', 'totalFlights', 'totalBookings',
            'confirmedBookings', 'cancelledBookings', 'totalRevenue',
            'months', 'monthlyBookingsData', 'monthlyRevenueData',
            'popularDestinations', 'statusDistribution', 'recentBookings'
        ));
    }
}
