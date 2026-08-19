@extends('layouts.app')

@section('content')
<div class="bg-slate-900 text-white py-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-sky-400">Flight Catalog</span>
                <h1 class="text-3xl font-extrabold tracking-tight text-white mt-1">Search Available Flights</h1>
            </div>
            <div class="text-xs font-medium text-slate-400">
                Found <span class="text-white font-bold">{{ $flights->total() }}</span> available scheduled flights
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filter Form -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 sticky top-28">
                <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                    <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                        <i data-lucide="sliders-horizontal" class="w-4 h-4 text-blue-600"></i> Filter Flights
                    </h3>
                    @if(request()->anyFilled(['origin', 'destination', 'departure_date', 'airline_id', 'price_min', 'price_max', 'time_range', 'sort_by']))
                        <a href="{{ route('flights.index') }}" class="text-xs font-semibold text-rose-600 hover:underline">Reset</a>
                    @endif
                </div>

                <form method="GET" action="{{ route('flights.index') }}" class="space-y-5">
                    <!-- Origin -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Origin</label>
                        <select name="origin" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            <option value="">All Airports</option>
                            @foreach($airports as $ap)
                                <option value="{{ $ap->code }}" {{ ($filters['origin'] ?? '') === $ap->code ? 'selected' : '' }}>{{ $ap->city }} ({{ $ap->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Destination -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Destination</label>
                        <select name="destination" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            <option value="">All Airports</option>
                            @foreach($airports as $ap)
                                <option value="{{ $ap->code }}" {{ ($filters['destination'] ?? '') === $ap->code ? 'selected' : '' }}>{{ $ap->city }} ({{ $ap->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Departure Date -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Departure Date</label>
                        <input type="date" name="departure_date" value="{{ $filters['departure_date'] ?? '' }}" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                    </div>

                    <!-- Passengers -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Min Available Seats</label>
                        <select name="passengers" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            <option value="1" {{ ($filters['passengers'] ?? '1') == '1' ? 'selected' : '' }}>1+ Seat</option>
                            <option value="2" {{ ($filters['passengers'] ?? '') == '2' ? 'selected' : '' }}>2+ Seats</option>
                            <option value="3" {{ ($filters['passengers'] ?? '') == '3' ? 'selected' : '' }}>3+ Seats</option>
                            <option value="4" {{ ($filters['passengers'] ?? '') == '4' ? 'selected' : '' }}>4+ Seats</option>
                        </select>
                    </div>

                    <!-- Airline -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Airline</label>
                        <select name="airline_id" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            <option value="">All Airlines</option>
                            @foreach($airlines as $al)
                                <option value="{{ $al->id }}" {{ ($filters['airline_id'] ?? '') == $al->id ? 'selected' : '' }}>{{ $al->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price Min/Max -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Price Range ($)</label>
                        <div class="grid grid-cols-2 gap-2">
                            <input type="number" name="price_min" value="{{ $filters['price_min'] ?? '' }}" placeholder="Min" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            <input type="number" name="price_max" value="{{ $filters['price_max'] ?? '' }}" placeholder="Max" class="w-full px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                        </div>
                    </div>

                    <!-- Sort By -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Sort By</label>
                        <select name="sort_by" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            <option value="departure" {{ ($filters['sort_by'] ?? '') === 'departure' ? 'selected' : '' }}>Departure Date & Time</option>
                            <option value="price_asc" {{ ($filters['sort_by'] ?? '') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ ($filters['sort_by'] ?? '') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="seats" {{ ($filters['sort_by'] ?? '') === 'seats' ? 'selected' : '' }}>Available Seats</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md transition-all">
                        Apply Filters
                    </button>
                </form>
            </div>
        </div>

        <!-- Flight Cards List -->
        <div class="lg:col-span-3 space-y-6">
            @if($flights->isEmpty())
                <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 space-y-4">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto">
                        <i data-lucide="plane-off" class="w-8 h-8"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="text-xl font-bold text-slate-900">No Flights Found</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">We couldn't find any flights matching your search criteria. Try modifying your filters or search parameters.</p>
                    </div>
                    <a href="{{ route('flights.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white font-semibold text-xs rounded-xl shadow-md">
                        Reset Filters
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($flights as $flight)
                        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 hover:border-blue-300 hover:shadow-md transition-all flex flex-col md:flex-row items-stretch justify-between gap-6">
                            <!-- Left: Airline info & flight timeline -->
                            <div class="flex-grow space-y-4">
                                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center font-bold text-blue-700 text-sm">
                                            {{ $flight->airline->code }}
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-slate-900 leading-none">{{ $flight->airline->name }}</h4>
                                            <span class="text-[11px] text-slate-400 font-mono mt-0.5 block">{{ $flight->flight_number }} &bull; {{ $flight->aircraft->model }}</span>
                                        </div>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-bold">
                                        {{ $flight->available_seats }} Seats Left
                                    </span>
                                </div>

                                <!-- Route Schedule -->
                                <div class="grid grid-cols-3 items-center text-center py-1">
                                    <div class="text-left space-y-0.5">
                                        <span class="text-2xl font-black text-slate-900">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</span>
                                        <span class="block text-xs font-bold text-slate-800">{{ $flight->originAirport->code }}</span>
                                        <span class="block text-[11px] text-slate-500 truncate">{{ $flight->originAirport->city }}</span>
                                        <span class="block text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($flight->departure_date)->format('M d, Y') }}</span>
                                    </div>

                                    <div class="space-y-1">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">{{ $flight->duration }}</span>
                                        <div class="relative flex items-center justify-center">
                                            <div class="w-full border-t-2 border-dashed border-slate-300"></div>
                                            <div class="absolute bg-white px-1 text-blue-600">
                                                <i data-lucide="plane" class="w-4 h-4 rotate-90"></i>
                                            </div>
                                        </div>
                                        <span class="text-[10px] text-slate-500 font-medium">Baggage: {{ $flight->baggage_allowance }}</span>
                                    </div>

                                    <div class="text-right space-y-0.5">
                                        <span class="text-2xl font-black text-slate-900">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</span>
                                        <span class="block text-xs font-bold text-slate-800">{{ $flight->destinationAirport->code }}</span>
                                        <span class="block text-[11px] text-slate-500 truncate">{{ $flight->destinationAirport->city }}</span>
                                        <span class="block text-[10px] text-slate-400">{{ \Carbon\Carbon::parse($flight->arrival_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Price & CTA -->
                            <div class="md:w-48 md:border-l border-slate-100 md:pl-6 flex flex-col justify-between items-center md:items-end pt-4 md:pt-0 border-t md:border-t-0">
                                <div class="text-center md:text-right space-y-0.5">
                                    <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Economy Class</span>
                                    <div class="text-3xl font-black text-slate-900">${{ number_format($flight->price, 2) }}</div>
                                    <span class="text-[10px] text-slate-500 font-medium">per passenger</span>
                                </div>

                                <div class="w-full space-y-2 mt-4">
                                    <a href="{{ route('flights.show', $flight) }}" class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition-all flex items-center justify-center gap-1">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i> Details
                                    </a>
                                    <a href="{{ route('flights.book', $flight) }}" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md shadow-blue-600/20 transition-all flex items-center justify-center gap-1">
                                        <span>Book Now</span>
                                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pt-4">
                    {{ $flights->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
