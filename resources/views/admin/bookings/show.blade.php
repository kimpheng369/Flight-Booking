@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Master Bookings
        </a>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-4 gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Master Record</span>
                <h1 class="text-2xl font-extrabold text-slate-900">Booking Reference: <span class="font-mono text-blue-600">{{ $booking->booking_reference }}</span></h1>
            </div>

            <!-- Quick Status Change Form -->
            <form method="POST" action="{{ route('admin.bookings.status', $booking) }}" class="flex items-center gap-2">
                @csrf
                <select name="booking_status" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800">
                    <option value="Confirmed" {{ $booking->booking_status === 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="Completed" {{ $booking->booking_status === 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $booking->booking_status === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <select name="payment_status" class="px-3 py-1.5 bg-slate-50 border border-slate-200 rounded-xl text-xs font-bold text-slate-800">
                    <option value="Paid" {{ $booking->payment_status === 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Unpaid" {{ $booking->payment_status === 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                    <option value="Refunded" {{ $booking->payment_status === 'Refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
                <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white font-bold text-xs rounded-xl shadow-sm">
                    Update
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
            <div class="p-5 rounded-2xl bg-slate-50 space-y-2 border border-slate-100">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[10px]">User Account</span>
                <p class="text-sm font-extrabold text-slate-900">{{ $booking->user->name }}</p>
                <p class="text-slate-600">Email: {{ $booking->user->email }}</p>
                <p class="text-slate-600">Phone: {{ $booking->user->phone ?? 'N/A' }}</p>
            </div>

            <div class="p-5 rounded-2xl bg-slate-50 space-y-2 border border-slate-100">
                <span class="font-bold text-slate-400 uppercase tracking-wider text-[10px]">Passenger Ticket Credentials</span>
                <p class="text-sm font-extrabold text-slate-900">{{ $booking->passenger->first_name }} {{ $booking->passenger->last_name }}</p>
                <p class="text-slate-600">Passport/ID: {{ $booking->passenger->passport_number }}</p>
                <p class="text-slate-600">Gender: {{ $booking->passenger->gender }} &bull; DOB: {{ $booking->passenger->date_of_birth ? \Carbon\Carbon::parse($booking->passenger->date_of_birth)->format('M d, Y') : 'N/A' }}</p>
            </div>
        </div>

        <div class="p-5 rounded-2xl bg-blue-50/60 border border-blue-100 space-y-3 text-xs">
            <span class="font-bold text-blue-900 uppercase tracking-wider text-[10px]">Flight Assignment</span>
            <div class="flex items-center justify-between font-bold text-slate-900 text-sm">
                <span>{{ $booking->flight->airline->name }} ({{ $booking->flight->flight_number }})</span>
                <span class="text-blue-700">{{ $booking->flight->originAirport->code }} &rarr; {{ $booking->flight->destinationAirport->code }}</span>
            </div>
            <p class="text-slate-600">Departure: {{ \Carbon\Carbon::parse($booking->flight->departure_date)->format('M d, Y') }} at {{ \Carbon\Carbon::parse($booking->flight->departure_time)->format('H:i') }}</p>
            <p class="text-slate-600">Aircraft: {{ $booking->flight->aircraft->model }} &bull; Seats Reserved: <strong>{{ $booking->seats }}</strong></p>
        </div>
    </div>
</div>
@endsection
