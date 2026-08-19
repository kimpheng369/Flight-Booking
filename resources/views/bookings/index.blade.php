@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Bookings</h1>
            <p class="text-xs text-slate-500">View and manage all your flight reservations and digital tickets.</p>
        </div>

        <!-- Search / Filter bar -->
        <form method="GET" action="{{ route('bookings.index') }}" class="flex items-center gap-3">
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Reference or Flight #" class="pl-9 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-3"></i>
            </div>
            <select name="status" onchange="this.form.submit()" class="px-3.5 py-2.5 bg-white border border-slate-200 rounded-xl text-xs font-semibold focus:ring-2 focus:ring-blue-600 focus:outline-none">
                <option value="">All Statuses</option>
                <option value="Confirmed" {{ request('status') === 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </form>
    </div>

    @if($bookings->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center border border-slate-200/80 space-y-4">
            <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto">
                <i data-lucide="ticket" class="w-8 h-8"></i>
            </div>
            <div class="space-y-1">
                <h3 class="text-xl font-bold text-slate-900">No Bookings Yet</h3>
                <p class="text-xs text-slate-500">You haven't booked any flights with SkyBook yet.</p>
            </div>
            <a href="{{ route('flights.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-bold text-xs rounded-xl shadow-md">
                <i data-lucide="search" class="w-4 h-4"></i> Search Flights Now
            </a>
        </div>
    @else
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                            <th class="py-4 px-6">Reference</th>
                            <th class="py-4 px-6">Flight</th>
                            <th class="py-4 px-6">Route</th>
                            <th class="py-4 px-6">Departure Date</th>
                            <th class="py-4 px-6">Passenger</th>
                            <th class="py-4 px-6 text-center">Seats</th>
                            <th class="py-4 px-6">Total Fare</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                        @foreach($bookings as $booking)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="py-4 px-6 font-mono font-bold text-blue-600">
                                    {{ $booking->booking_reference }}
                                </td>
                                <td class="py-4 px-6">
                                    <div class="font-bold text-slate-900">{{ $booking->flight->airline->name }}</div>
                                    <div class="text-[11px] text-slate-400 font-mono">{{ $booking->flight->flight_number }}</div>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-bold text-slate-800">{{ $booking->flight->originAirport->code }}</span>
                                    <span class="text-slate-400">&rarr;</span>
                                    <span class="font-bold text-slate-800">{{ $booking->flight->destinationAirport->code }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    {{ \Carbon\Carbon::parse($booking->flight->departure_date)->format('M d, Y') }}
                                    <span class="block text-[11px] text-slate-400">{{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('H:i') }}</span>
                                </td>
                                <td class="py-4 px-6 font-semibold text-slate-900">
                                    {{ $booking->passenger->first_name }} {{ $booking->passenger->last_name }}
                                </td>
                                <td class="py-4 px-6 text-center font-bold">
                                    {{ $booking->seats }}
                                </td>
                                <td class="py-4 px-6 font-black text-slate-900">
                                    ${{ number_format($booking->total_price, 2) }}
                                </td>
                                <td class="py-4 px-6">
                                    @if($booking->booking_status === 'Confirmed')
                                        <span class="px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-[11px] font-bold">Confirmed</span>
                                    @elseif($booking->booking_status === 'Completed')
                                        <span class="px-2.5 py-1 rounded-full bg-blue-50 border border-blue-200 text-blue-700 text-[11px] font-bold">Completed</span>
                                    @else
                                        <span class="px-2.5 py-1 rounded-full bg-rose-50 border border-rose-200 text-rose-700 text-[11px] font-bold">Cancelled</span>
                                    @endif
                                </td>
                                <td class="py-4 px-6 text-right space-x-2">
                                    <a href="{{ route('bookings.show', $booking) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold rounded-lg transition-colors">
                                        <i data-lucide="ticket" class="w-3.5 h-3.5"></i> Ticket
                                    </a>
                                    @if($booking->booking_status === 'Confirmed')
                                        <form method="POST" action="{{ route('bookings.cancel', $booking) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to cancel this booking? Seats will be restored to inventory.');">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 font-bold rounded-lg transition-colors">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $bookings->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
