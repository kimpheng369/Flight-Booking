@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Action Bar (Hidden during print) -->
    <div class="flex items-center justify-between mb-8 print:hidden">
        <a href="{{ route('bookings.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-slate-500 hover:text-blue-600">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to My Bookings
        </a>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md transition-all flex items-center gap-2">
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>Print Ticket</span>
            </button>
            @if($booking->booking_status === 'Confirmed')
                <form method="POST" action="{{ route('bookings.cancel', $booking) }}" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold text-xs rounded-xl border border-rose-200 transition-all">
                        Cancel Booking
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- E-TICKET BOARDING PASS CARD -->
    <div class="bg-white rounded-3xl shadow-xl border border-slate-200 overflow-hidden relative print:shadow-none print:border-slate-400">
        <!-- Ticket Header -->
        <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-slate-900 text-white p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b-4 border-blue-500">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl bg-white/10 backdrop-blur border border-white/20 flex items-center justify-center font-bold text-white text-lg">
                    {{ $booking->flight->airline->code }}
                </div>
                <div>
                    <span class="text-[10px] uppercase font-bold tracking-widest text-blue-300">Official E-Ticket Boarding Pass</span>
                    <h2 class="text-2xl font-black tracking-tight">SkyBook Airlines</h2>
                </div>
            </div>

            <div class="text-left sm:text-right space-y-0.5">
                <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Booking Reference</span>
                <div class="text-2xl font-black font-mono text-sky-400 tracking-wider">{{ $booking->booking_reference }}</div>
            </div>
        </div>

        <!-- Ticket Body -->
        <div class="p-8 space-y-8">
            <!-- Flight Route Timeline -->
            <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200/70">
                <div class="grid grid-cols-1 sm:grid-cols-3 items-center text-center gap-6">
                    <div class="text-left space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600">Origin</span>
                        <div class="text-3xl font-black text-slate-900">{{ $booking->flight->originAirport->code }}</div>
                        <div class="text-sm font-bold text-slate-800">{{ $booking->flight->originAirport->city }}</div>
                        <div class="text-xs text-slate-500 font-semibold">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('H:i') }} &bull; {{ \Carbon\Carbon::parse($booking->flight->departure_date)->format('M d, Y') }}</div>
                    </div>

                    <div class="space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">{{ $booking->flight->duration }}</span>
                        <div class="relative flex items-center justify-center">
                            <div class="w-full border-t-2 border-dashed border-slate-300"></div>
                            <div class="absolute bg-slate-50 px-2 text-blue-600">
                                <i data-lucide="plane" class="w-5 h-5 rotate-90"></i>
                            </div>
                        </div>
                        <span class="text-xs font-mono font-bold text-slate-700">{{ $booking->flight->flight_number }}</span>
                    </div>

                    <div class="text-right space-y-1">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600">Destination</span>
                        <div class="text-3xl font-black text-slate-900">{{ $booking->flight->destinationAirport->code }}</div>
                        <div class="text-sm font-bold text-slate-800">{{ $booking->flight->destinationAirport->city }}</div>
                        <div class="text-xs text-slate-500 font-semibold">{{ \Carbon\Carbon::parse($booking->flight->arrival_time)->format('H:i') }} &bull; {{ \Carbon\Carbon::parse($booking->flight->arrival_date)->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-2">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Passenger Name</span>
                    <p class="text-sm font-extrabold text-slate-900">{{ $booking->passenger->first_name }} {{ $booking->passenger->last_name }}</p>
                    <span class="text-[11px] text-slate-500">ID: {{ $booking->passenger->passport_number ?? 'N/A' }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Airline / Aircraft</span>
                    <p class="text-sm font-extrabold text-slate-900">{{ $booking->flight->airline->name }}</p>
                    <span class="text-[11px] text-slate-500">{{ $booking->flight->aircraft->model }}</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Seat Capacity</span>
                    <p class="text-sm font-extrabold text-slate-900">{{ $booking->seats }} {{ Str::plural('Seat', $booking->seats) }}</p>
                    <span class="text-[11px] text-slate-500">Economy Class</span>
                </div>

                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Price</span>
                    <p class="text-sm font-extrabold text-slate-900">${{ number_format($booking->total_price, 2) }}</p>
                    <span class="text-[11px] text-emerald-600 font-bold">Status: {{ $booking->payment_status }}</span>
                </div>
            </div>

            <!-- Status Badges & Simulated Barcode -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Booking Status</span>
                        <div class="mt-0.5">
                            @if($booking->booking_status === 'Confirmed')
                                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full text-xs font-bold">Confirmed</span>
                            @elseif($booking->booking_status === 'Completed')
                                <span class="px-3 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded-full text-xs font-bold">Completed</span>
                            @else
                                <span class="px-3 py-1 bg-rose-50 text-rose-700 border border-rose-200 rounded-full text-xs font-bold">Cancelled</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Simulated Boarding Barcode Graphic -->
                <div class="flex flex-col items-center sm:items-end">
                    <div class="h-10 w-48 bg-slate-900 flex items-center justify-between px-2 gap-1 rounded">
                        @for($b=0; $b<30; $b++)
                            <div class="h-full bg-white {{ $b%3==0 ? 'w-1' : ($b%5==0 ? 'w-1.5' : 'w-0.5') }}"></div>
                        @endfor
                    </div>
                    <span class="text-[9px] font-mono tracking-widest text-slate-400 mt-1 uppercase">{{ $booking->booking_reference }} &bull; SKYBOOK SECURITY CHECKED</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
