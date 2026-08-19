@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-6">
        <a href="{{ route('flights.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-slate-500 hover:text-blue-600 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Flight Search
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-200/80 overflow-hidden">
        <!-- Banner Header -->
        <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-slate-900 p-8 text-white flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center font-black text-xl text-white">
                    {{ $flight->airline->code }}
                </div>
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <h1 class="text-2xl font-extrabold tracking-tight">{{ $flight->airline->name }}</h1>
                        <span class="px-2.5 py-0.5 rounded-full bg-blue-500/20 text-blue-300 text-xs font-mono font-bold">{{ $flight->flight_number }}</span>
                    </div>
                    <p class="text-xs text-slate-300">Aircraft Model: {{ $flight->aircraft->model }} (Reg: {{ $flight->aircraft->registration_number }})</p>
                </div>
            </div>

            <div class="text-left md:text-right space-y-1">
                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Ticket Fare</span>
                <div class="text-3xl font-black text-white">${{ number_format($flight->price, 2) }} <span class="text-xs font-normal text-slate-400">/ seat</span></div>
            </div>
        </div>

        <div class="p-8 space-y-8">
            <!-- Timeline Route -->
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/60">
                <div class="grid grid-cols-1 md:grid-cols-3 items-center text-center gap-6">
                    <!-- Departure -->
                    <div class="text-left space-y-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Departure</span>
                        <div class="text-3xl font-black text-slate-900">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</div>
                        <div class="text-base font-bold text-slate-800">{{ $flight->originAirport->name }} ({{ $flight->originAirport->code }})</div>
                        <div class="text-xs text-slate-500">{{ $flight->originAirport->city }}, {{ $flight->originAirport->country }}</div>
                        <div class="text-xs font-semibold text-slate-700 mt-1">{{ \Carbon\Carbon::parse($flight->departure_date)->format('l, F j, Y') }}</div>
                    </div>

                    <!-- Flight Duration -->
                    <div class="space-y-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Flight Duration</span>
                        <div class="text-sm font-extrabold text-slate-800">{{ $flight->duration }}</div>
                        <div class="relative flex items-center justify-center">
                            <div class="w-full border-t-2 border-dashed border-slate-300"></div>
                            <div class="absolute bg-slate-50 px-2 text-blue-600">
                                <i data-lucide="plane" class="w-5 h-5 rotate-90"></i>
                            </div>
                        </div>
                        <span class="text-xs text-emerald-600 font-bold">Nonstop Flight</span>
                    </div>

                    <!-- Arrival -->
                    <div class="text-right space-y-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Arrival</span>
                        <div class="text-3xl font-black text-slate-900">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }}</div>
                        <div class="text-base font-bold text-slate-800">{{ $flight->destinationAirport->name }} ({{ $flight->destinationAirport->code }})</div>
                        <div class="text-xs text-slate-500">{{ $flight->destinationAirport->city }}, {{ $flight->destinationAirport->country }}</div>
                        <div class="text-xs font-semibold text-slate-700 mt-1">{{ \Carbon\Carbon::parse($flight->arrival_date)->format('l, F j, Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Features & Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-5 rounded-2xl bg-white border border-slate-200 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <i data-lucide="armchair" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Available Seats</span>
                        <p class="text-base font-bold text-slate-900">{{ $flight->available_seats }} / {{ $flight->total_seats }} Seats</p>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <i data-lucide="luggage" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Baggage Included</span>
                        <p class="text-base font-bold text-slate-900">{{ $flight->baggage_allowance }} Checked</p>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-white border border-slate-200 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Flight Status</span>
                        <p class="text-base font-bold text-emerald-700">{{ $flight->status }}</p>
                    </div>
                </div>
            </div>

            <!-- CTA Action -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-500">
                    Need assistance or group booking? Contact <a href="mailto:support@skybook.test" class="text-blue-600 font-bold hover:underline">support@skybook.test</a>
                </div>

                @if($flight->available_seats > 0 && $flight->status !== 'Cancelled')
                    <a href="{{ route('flights.book', $flight) }}" class="w-full sm:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-sm rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all flex items-center justify-center gap-2">
                        <span>Book This Flight</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                @else
                    <button disabled class="w-full sm:w-auto px-8 py-4 bg-slate-200 text-slate-500 font-extrabold text-sm rounded-xl cursor-not-allowed">
                        Flight Fully Booked
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
