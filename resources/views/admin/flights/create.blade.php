@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-6">
        <a href="{{ route('admin.flights.index') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Flights
        </a>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Create New Scheduled Flight</h1>

        <form method="POST" action="{{ route('admin.flights.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Flight Number -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Flight Number</label>
                    <input type="text" name="flight_number" value="{{ old('flight_number', 'K6-901') }}" required placeholder="e.g. SK-101" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold">
                    @error('flight_number') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Airline -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Airline</label>
                    <select name="airline_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                        @foreach($airlines as $al)
                            <option value="{{ $al->id }}">{{ $al->name }} ({{ $al->code }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Aircraft -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Aircraft</label>
                    <select name="aircraft_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                        @foreach($aircrafts as $ac)
                            <option value="{{ $ac->id }}">{{ $ac->model }} ({{ $ac->registration_number }}) - Cap: {{ $ac->seat_capacity }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Price -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Price ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', '150.00') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold">
                    @error('price') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Origin Airport -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Origin Airport</label>
                    <select name="origin_airport_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                        @foreach($airports as $ap)
                            <option value="{{ $ap->id }}">{{ $ap->city }} ({{ $ap->code }}) - {{ $ap->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Destination Airport -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Destination Airport</label>
                    <select name="destination_airport_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                        @foreach($airports as $ap)
                            <option value="{{ $ap->id }}" {{ $loop->index == 1 ? 'selected' : '' }}>{{ $ap->city }} ({{ $ap->code }}) - {{ $ap->name }}</option>
                        @endforeach
                    </select>
                    @error('destination_airport_id') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Departure Date -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Departure Date</label>
                    <input type="date" name="departure_date" value="{{ old('departure_date', date('Y-m-d')) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                </div>

                <!-- Departure Time -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Departure Time</label>
                    <input type="time" name="departure_time" value="{{ old('departure_time', '09:00') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                </div>

                <!-- Arrival Date -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Arrival Date</label>
                    <input type="date" name="arrival_date" value="{{ old('arrival_date', date('Y-m-d')) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                    @error('arrival_date') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Arrival Time -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Arrival Time</label>
                    <input type="time" name="arrival_time" value="{{ old('arrival_time', '11:15') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                </div>

                <!-- Total Seats -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Total Seats</label>
                    <input type="number" name="total_seats" value="{{ old('total_seats', '180') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold">
                    @error('total_seats') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Available Seats -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Available Seats</label>
                    <input type="number" name="available_seats" value="{{ old('available_seats', '180') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold">
                    @error('available_seats') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Baggage Allowance -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Baggage Allowance</label>
                    <input type="text" name="baggage_allowance" value="{{ old('baggage_allowance', '20kg') }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Status</label>
                    <select name="status" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                        <option value="Scheduled">Scheduled</option>
                        <option value="Boarding">Boarding</option>
                        <option value="Departed">Departed</option>
                        <option value="Arrived">Arrived</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Create Flight
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
