@extends('layouts.app')

@section('content')
<!-- Hero Section with Flight Search -->
<div class="relative bg-slate-900 overflow-hidden pt-12 pb-24 lg:pt-20 lg:pb-32">
    <!-- Ambient Background Graphic -->
    <div class="absolute inset-0 z-0 opacity-30 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-blue-600 via-sky-900 to-slate-950"></div>
    <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-12">
            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-500/10 border border-blue-400/20 text-blue-300 text-xs font-semibold uppercase tracking-wider">
                <i data-lucide="sparkles" class="w-4 h-4"></i> Premium Flight Reservation System
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-none">
                Find Your Next <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-sky-300">Flight</span>
            </h1>
            <p class="text-base sm:text-lg text-slate-300 font-normal">
                Search, compare and book flights easily with SkyBook's modern reservation platform.
            </p>
        </div>

        <!-- Flight Search Widget Card -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 shadow-2xl shadow-slate-950/40 border border-slate-100 max-w-5xl mx-auto">
            <form action="{{ route('flights.index') }}" method="GET" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- From Origin -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500">From</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="plane-takeoff" class="w-5 h-5"></i>
                            </div>
                            <select name="origin" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                                <option value="">Any Origin Airport</option>
                                @foreach($airports as $ap)
                                    <option value="{{ $ap->code }}">{{ $ap->city }} ({{ $ap->code }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- To Destination -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500">To</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="plane-landing" class="w-5 h-5"></i>
                            </div>
                            <select name="destination" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                                <option value="">Any Destination</option>
                                @foreach($airports as $ap)
                                    <option value="{{ $ap->code }}">{{ $ap->city }} ({{ $ap->code }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Departure Date -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500">Departure Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                            </div>
                            <input type="date" name="departure_date" min="{{ date('Y-m-d') }}" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                        </div>
                    </div>

                    <!-- Passengers -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-500">Passengers</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i data-lucide="users" class="w-5 h-5"></i>
                            </div>
                            <select name="passengers" class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                                <option value="1">1 Passenger</option>
                                <option value="2">2 Passengers</option>
                                <option value="3">3 Passengers</option>
                                <option value="4">4 Passengers</option>
                                <option value="5">5+ Passengers</option>
                            </select>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="space-y-1.5 flex flex-col justify-end">
                        <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all flex items-center justify-center gap-2">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span>Search Flights</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Popular Destinations Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Top Hubs & Routes</span>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-1">Popular Destinations</h2>
        </div>
        <a href="{{ route('flights.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-700 flex items-center gap-1 mt-4 md:mt-0">
            <span>Explore All Routes</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: USA (New York City) -->
        <a href="{{ route('flights.index', ['destination' => 'JFK']) }}" class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-80 flex flex-col justify-end p-6 bg-slate-800">
            <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?w=800&auto=format&fit=crop&q=80" alt="New York City" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            <div class="relative z-10 space-y-1">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-400">United States</span>
                <h3 class="text-xl font-bold text-white">New York City (JFK)</h3>
                <p class="text-xs text-slate-300 font-medium">Transatlantic flights from $750</p>
            </div>
        </a>

        <!-- Card 2: France (Paris) -->
        <a href="{{ route('flights.index', ['destination' => 'CDG']) }}" class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-80 flex flex-col justify-end p-6 bg-slate-800">
            <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=800&auto=format&fit=crop&q=80" alt="Paris" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            <div class="relative z-10 space-y-1">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-400">France</span>
                <h3 class="text-xl font-bold text-white">Paris (CDG)</h3>
                <p class="text-xs text-slate-300 font-medium">Daily flights from $680</p>
            </div>
        </a>

        <!-- Card 3: Cambodia (Angkor Wat) -->
        <a href="{{ route('flights.index', ['destination' => 'SAI']) }}" class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-80 flex flex-col justify-end p-6 bg-slate-800">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop&q=80" alt="Angkor Wat" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            <div class="relative z-10 space-y-1">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-400">Cambodia</span>
                <h3 class="text-xl font-bold text-white">Siem Reap (Angkor Wat)</h3>
                <p class="text-xs text-slate-300 font-medium">Nonstop flights from $65</p>
            </div>
        </a>

        <!-- Card 4: Japan (Tokyo) -->
        <a href="{{ route('flights.index', ['destination' => 'HND']) }}" class="group relative rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 h-80 flex flex-col justify-end p-6 bg-slate-800">
            <img src="https://images.unsplash.com/photo-1503899036084-c55cdd92da26?w=800&auto=format&fit=crop&q=80" alt="Tokyo" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            <div class="relative z-10 space-y-1">
                <span class="text-xs font-bold uppercase tracking-wider text-sky-400">Japan</span>
                <h3 class="text-xl font-bold text-white">Tokyo Haneda (HND)</h3>
                <p class="text-xs text-slate-300 font-medium">Nonstop flights from $580</p>
            </div>
        </a>
    </div>
</div>

<!-- Featured Available Flights -->
<div class="bg-slate-100/70 py-20 border-y border-slate-200/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-14 space-y-2">
            <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Featured Schedules</span>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Available Flights Today</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredFlights as $flight)
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 hover:shadow-xl transition-all flex flex-col justify-between space-y-6">
                    <!-- Airline & Status Header -->
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center font-bold text-blue-700 text-sm">
                                {{ $flight->airline->code }}
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-900 leading-tight">{{ $flight->airline->name }}</h4>
                                <span class="text-xs text-slate-500 font-mono">{{ $flight->flight_number }}</span>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold">
                            {{ $flight->available_seats }} Seats Left
                        </span>
                    </div>

                    <!-- Flight Route Timeline -->
                    <div class="grid grid-cols-3 items-center text-center">
                        <div class="space-y-0.5">
                            <span class="text-2xl font-black text-slate-900">{{ $flight->originAirport->code }}</span>
                            <span class="block text-xs font-medium text-slate-500 truncate">{{ $flight->originAirport->city }}</span>
                            <span class="block text-xs font-bold text-blue-600 mt-1">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</span>
                        </div>

                        <div class="space-y-1">
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">{{ $flight->duration }}</span>
                            <div class="relative flex items-center justify-center">
                                <div class="w-full border-t-2 border-dashed border-slate-300"></div>
                                <div class="absolute bg-white px-1 text-blue-600">
                                    <i data-lucide="plane" class="w-4 h-4 rotate-90"></i>
                                </div>
                            </div>
                            <span class="text-[10px] text-slate-500 font-medium">Nonstop</span>
                        </div>

                        <div class="space-y-0.5">
                            <span class="text-2xl font-black text-slate-900">{{ $flight->destinationAirport->code }}</span>
                            <span class="block text-xs font-medium text-slate-500 truncate">{{ $flight->destinationAirport->city }}</span>
                            <span class="block text-xs font-bold text-blue-600 mt-1">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</span>
                        </div>
                    </div>

                    <!-- Footer Details & Action -->
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">From</span>
                            <div class="text-xl font-black text-slate-900">${{ number_format($flight->price, 2) }}</div>
                        </div>
                        <a href="{{ route('flights.show', $flight) }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md shadow-blue-600/20 transition-all flex items-center gap-1.5">
                            <span>Book Now</span>
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Why Choose SkyBook Section -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="text-center max-w-2xl mx-auto mb-16 space-y-2">
        <span class="text-xs font-bold uppercase tracking-widest text-blue-600">Why Fly With Us</span>
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">The SkyBook Advantage</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-300 transition-colors">
            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <i data-lucide="shield-check" class="w-7 h-7"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900">Guaranteed Seat Booking</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
                Our transaction-locked seat engine ensures your seat is reserved real-time without overbooking risks.
            </p>
        </div>

        <div class="p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-300 transition-colors">
            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center">
                <i data-lucide="badge-percent" class="w-7 h-7"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900">Transparent Fares</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
                No hidden fees or surprise surcharges. The price you see on search is exactly what you pay.
            </p>
        </div>

        <div class="p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-4 hover:border-blue-300 transition-colors">
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <i data-lucide="ticket" class="w-7 h-7"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900">Instant Digital Boarding Pass</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
                Receive instant ticket confirmations with printable e-ticket boarding passes right in your dashboard.
            </p>
        </div>
    </div>
</div>

<!-- Simple Statistics Banner -->
<div class="bg-gradient-to-r from-blue-900 via-blue-800 to-slate-900 py-16 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="space-y-1">
                <div class="text-4xl sm:text-5xl font-black">{{ $stats['total_flights'] }}</div>
                <div class="text-xs uppercase font-bold tracking-widest text-blue-300">Scheduled Flights</div>
            </div>

            <div class="space-y-1">
                <div class="text-4xl sm:text-5xl font-black">{{ $stats['total_bookings'] }}</div>
                <div class="text-xs uppercase font-bold tracking-widest text-blue-300">Confirmed Bookings</div>
            </div>

            <div class="space-y-1">
                <div class="text-4xl sm:text-5xl font-black">{{ $stats['airports_count'] }}</div>
                <div class="text-xs uppercase font-bold tracking-widest text-blue-300">Airport Hubs</div>
            </div>

            <div class="space-y-1">
                <div class="text-4xl sm:text-5xl font-black">{{ $stats['airlines_count'] }}</div>
                <div class="text-xs uppercase font-bold tracking-widest text-blue-300">Partner Airlines</div>
            </div>
        </div>
    </div>
</div>
@endsection
