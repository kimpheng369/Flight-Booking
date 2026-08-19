@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Stepper Navigation Header -->
    <div class="mb-8 flex items-center justify-between border-b border-slate-200 pb-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400">
            <span>1. Search Flight</span>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-blue-600">2. Passenger Info & Payment</span>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span>3. Ticket Issued</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Flight Brief Summary Box -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4 sticky top-28">
                <h3 class="text-base font-extrabold text-slate-900 pb-3 border-b border-slate-100 flex items-center gap-2">
                    <i data-lucide="plane" class="w-4 h-4 text-blue-600"></i> Flight Summary
                </h3>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">Airline</span>
                        <span class="text-xs font-bold text-slate-900">{{ $flight->airline->name }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">Flight No.</span>
                        <span class="text-xs font-mono font-bold text-slate-900">{{ $flight->flight_number }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">Route</span>
                        <span class="text-xs font-bold text-blue-600">{{ $flight->originAirport->code }} &rarr; {{ $flight->destinationAirport->code }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">Departure Date</span>
                        <span class="text-xs font-bold text-slate-900">{{ \Carbon\Carbon::parse($flight->departure_date)->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">Departure Time</span>
                        <span class="text-xs font-bold text-slate-900">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-500 font-medium">Fare per seat</span>
                        <span class="text-xs font-bold text-slate-900">${{ number_format($flight->price, 2) }}</span>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 space-y-1">
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Price</span>
                    <div class="text-3xl font-black text-blue-700" id="total-price-display">${{ number_format($totalPrice, 2) }}</div>
                </div>
            </div>
        </div>

        <!-- Passenger Form & Simulated Payment -->
        <div class="lg:col-span-2 space-y-6">
            <form method="POST" action="{{ route('flights.book.store', $flight) }}" class="space-y-6">
                @csrf

                <!-- Passenger Details Card -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h2 class="text-xl font-extrabold text-slate-900 tracking-tight">Passenger Information</h2>
                        <p class="text-xs text-slate-500">Please enter passenger credentials as shown on official ID / passport.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Seats Count -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Number of Seats</label>
                            <select name="seats" id="seats-select" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold text-slate-900 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                                @for($i = 1; $i <= min(9, $flight->available_seats); $i++)
                                    <option value="{{ $i }}" {{ $seats == $i ? 'selected' : '' }}>{{ $i }} {{ Str::plural('Seat', $i) }} (${{ number_format($flight->price * $i, 2) }})</option>
                                @endfor
                            </select>
                        </div>

                        <!-- First Name -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name', explode(' ', auth()->user()->name)[0] ?? '') }}" required placeholder="First Name" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            @error('first_name') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name', explode(' ', auth()->user()->name)[1] ?? '') }}" required placeholder="Last Name" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            @error('last_name') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Gender -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Gender</label>
                            <select name="gender" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Date of Birth</label>
                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth', '1996-08-20') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            @error('date_of_birth') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Passport / ID Number -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Passport / ID Number</label>
                            <input type="text" name="passport_number" value="{{ old('passport_number', 'N8291034') }}" required placeholder="N1234567" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                            @error('passport_number') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone -->
                        <div class="space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone ?? '+855 12 345 678') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                        </div>

                        <!-- Email -->
                        <div class="sm:col-span-2 space-y-1.5">
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Email Address for E-Ticket</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:outline-none">
                        </div>
                    </div>
                </div>

                <!-- Simulated Payment Gateway Box -->
                <div class="bg-gradient-to-br from-slate-900 to-blue-950 text-white rounded-3xl p-8 shadow-xl space-y-6">
                    <div class="flex items-center justify-between border-b border-white/10 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-500/20 text-sky-400 flex items-center justify-center">
                                <i data-lucide="credit-card" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold">Simulated Payment Checkout</h3>
                                <span class="text-xs text-slate-400">Sandbox Student Demo Mode — Instant Approval</span>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 text-xs font-bold rounded-full">
                            Secured SSL
                        </span>
                    </div>

                    <div class="p-4 bg-white/5 rounded-2xl border border-white/10 text-xs text-slate-300 space-y-2">
                        <div class="flex items-center gap-2 font-semibold text-white">
                            <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i> No real credit card charge will occur.
                        </div>
                        <p class="text-[11px] leading-relaxed text-slate-400">
                            Clicking <strong>Pay Now & Confirm Booking</strong> will run a database transaction to verify seat availability, lock inventory, issue your unique reference code, and create your e-ticket.
                        </p>
                    </div>

                    <button type="submit" class="w-full py-4 bg-blue-600 hover:bg-blue-500 text-white font-extrabold text-base rounded-2xl shadow-xl shadow-blue-600/30 hover:shadow-blue-500/50 transition-all flex items-center justify-center gap-2">
                        <i data-lucide="lock" class="w-5 h-5"></i>
                        <span>Pay Now & Confirm Booking</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('seats-select')?.addEventListener('change', function() {
        const seats = parseInt(this.value);
        const pricePerSeat = {{ $flight->price }};
        const total = (seats * pricePerSeat).toFixed(2);
        document.getElementById('total-price-display').innerText = '$' + total;
    });
</script>
@endsection
