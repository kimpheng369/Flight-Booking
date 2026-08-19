@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Welcome Header -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 rounded-3xl p-8 text-white shadow-xl mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div class="space-y-2">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-400">Customer Portal</span>
            <h1 class="text-3xl font-extrabold tracking-tight">Welcome Back, {{ $user->name }}!</h1>
            <p class="text-xs text-slate-300">Manage your active flight bookings, view e-tickets, and plan your next journey.</p>
        </div>
        <div>
            <a href="{{ route('flights.index') }}" class="px-6 py-3.5 bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs rounded-xl shadow-lg shadow-blue-600/30 transition-all inline-flex items-center gap-2">
                <i data-lucide="search" class="w-4 h-4"></i>
                <span>Book New Flight</span>
            </a>
        </div>
    </div>

    <!-- Stat Metrics Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-2">
            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="ticket" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Bookings</span>
            <div class="text-3xl font-black text-slate-900">{{ $totalBookings }}</div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-2">
            <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <i data-lucide="plane-takeoff" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Upcoming Flights</span>
            <div class="text-3xl font-black text-slate-900">{{ $upcomingCount }}</div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-2">
            <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Completed Trips</span>
            <div class="text-3xl font-black text-slate-900">{{ $completedCount }}</div>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-2">
            <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center">
                <i data-lucide="x-circle" class="w-5 h-5"></i>
            </div>
            <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Cancelled</span>
            <div class="text-3xl font-black text-slate-900">{{ $cancelledCount }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Upcoming Flights Column -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                    <i data-lucide="calendar" class="w-5 h-5 text-blue-600"></i> Next Upcoming Flight
                </h3>
                <a href="{{ route('bookings.index') }}" class="text-xs font-bold text-blue-600 hover:underline">View All</a>
            </div>

            @if($upcomingFlights->isEmpty())
                <div class="bg-white rounded-3xl p-8 text-center border border-slate-200/80 space-y-3">
                    <p class="text-xs text-slate-500 font-medium">You have no upcoming flight departures scheduled.</p>
                    <a href="{{ route('flights.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-50 text-blue-600 font-bold text-xs rounded-xl">
                        Search Flights
                    </a>
                </div>
            @else
                @foreach($upcomingFlights as $booking)
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 font-bold flex items-center justify-center text-xs">
                                    {{ $booking->flight->airline->code }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900">{{ $booking->flight->airline->name }}</h4>
                                    <span class="text-[11px] text-slate-400 font-mono">{{ $booking->flight->flight_number }}</span>
                                </div>
                            </div>
                            <span class="text-xs font-mono font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-100">
                                {{ $booking->booking_reference }}
                            </span>
                        </div>

                        <div class="grid grid-cols-3 items-center text-center">
                            <div class="text-left">
                                <span class="text-2xl font-black text-slate-900">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('H:i') }}</span>
                                <span class="block text-xs font-bold text-slate-800">{{ $booking->flight->originAirport->code }}</span>
                                <span class="block text-[11px] text-slate-500">{{ \Carbon\Carbon::parse($booking->flight->departure_date)->format('M d, Y') }}</span>
                            </div>

                            <div class="space-y-1">
                                <span class="text-[10px] text-slate-400 font-bold">{{ $booking->flight->duration }}</span>
                                <div class="relative flex items-center justify-center">
                                    <div class="w-full border-t-2 border-dashed border-slate-300"></div>
                                    <div class="absolute bg-white px-1 text-blue-600">
                                        <i data-lucide="plane" class="w-4 h-4 rotate-90"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <span class="text-2xl font-black text-slate-900">{{ \Carbon\Carbon::parse($booking->flight->arrival_time)->format('H:i') }}</span>
                                <span class="block text-xs font-bold text-slate-800">{{ $booking->flight->destinationAirport->code }}</span>
                                <span class="block text-[11px] text-slate-500">{{ \Carbon\Carbon::parse($booking->flight->arrival_date)->format('M d, Y') }}</span>
                            </div>
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-medium text-slate-500">Passenger: <strong>{{ $booking->passenger->first_name }} {{ $booking->passenger->last_name }}</strong></span>
                            <a href="{{ route('bookings.show', $booking) }}" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl flex items-center gap-1">
                                <i data-lucide="ticket" class="w-3.5 h-3.5"></i> View Ticket
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Recent Activity Column -->
        <div class="space-y-6">
            <h3 class="text-xl font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                <i data-lucide="clock" class="w-5 h-5 text-blue-600"></i> Recent Activity
            </h3>

            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
                @if($recentBookings->isEmpty())
                    <p class="text-xs text-slate-500 text-center py-4">No recent booking records.</p>
                @else
                    <div class="space-y-3">
                        @foreach($recentBookings as $b)
                            <div class="p-3 bg-slate-50 rounded-2xl flex items-center justify-between border border-slate-100">
                                <div>
                                    <span class="block text-xs font-mono font-bold text-blue-600">{{ $b->booking_reference }}</span>
                                    <span class="text-[11px] text-slate-600">{{ $b->flight->originAirport->code }} &rarr; {{ $b->flight->destinationAirport->code }}</span>
                                </div>
                                <span class="text-xs font-black text-slate-900">${{ number_format($b->total_price, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
