@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Master Booking Management</h1>
            <p class="text-xs text-slate-500">Monitor passenger reservations, change booking statuses, and manage payments.</p>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200/80 mb-6">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search Ref / Passenger / Email" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
            <select name="status" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                <option value="">All Booking Statuses</option>
                <option value="Confirmed" {{ request('status') === 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Completed" {{ request('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <select name="payment" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                <option value="">All Payment Statuses</option>
                <option value="Paid" {{ request('payment') === 'Paid' ? 'selected' : '' }}>Paid</option>
                <option value="Unpaid" {{ request('payment') === 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="Refunded" {{ request('payment') === 'Refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
            <button type="submit" class="py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl">
                Filter Bookings
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <th class="p-4">Reference</th>
                        <th class="p-4">Customer</th>
                        <th class="p-4">Passenger Name</th>
                        <th class="p-4">Flight</th>
                        <th class="p-4">Seats</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Booking Status</th>
                        <th class="p-4">Payment</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($bookings as $b)
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-mono font-bold text-blue-600">
                                <a href="{{ route('admin.bookings.show', $b) }}" class="hover:underline">{{ $b->booking_reference }}</a>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-slate-900">{{ $b->user->name }}</div>
                                <span class="text-[11px] text-slate-400">{{ $b->user->email }}</span>
                            </td>
                            <td class="p-4 font-semibold text-slate-800">
                                {{ $b->passenger->first_name }} {{ $b->passenger->last_name }}
                            </td>
                            <td class="p-4">
                                <span class="font-bold text-slate-900">{{ $b->flight->flight_number }}</span>
                                <span class="text-slate-500 font-normal">({{ $b->flight->originAirport->code }}&rarr;{{ $b->flight->destinationAirport->code }})</span>
                            </td>
                            <td class="p-4 font-bold text-center">{{ $b->seats }}</td>
                            <td class="p-4 font-black text-slate-900">${{ number_format($b->total_price, 2) }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $b->booking_status === 'Cancelled' ? 'bg-rose-50 text-rose-700' : ($b->booking_status === 'Confirmed' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700') }}">
                                    {{ $b->booking_status }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $b->payment_status === 'Paid' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                                    {{ $b->payment_status }}
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.bookings.show', $b) }}" class="text-blue-600 font-bold hover:underline">Manage</a>
                                @if($b->booking_status !== 'Cancelled')
                                    <form method="POST" action="{{ route('admin.bookings.cancel', $b) }}" class="inline-block" onsubmit="return confirm('Cancel this booking & restore seats?');">
                                        @csrf
                                        <button type="submit" class="text-rose-600 font-bold hover:underline">Cancel</button>
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
</div>
@endsection
