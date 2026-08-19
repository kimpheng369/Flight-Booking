@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Flight Management</h1>
            <p class="text-xs text-slate-500">Create, edit, search and manage scheduled flights across all routes.</p>
        </div>
        <a href="{{ route('admin.flights.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-1.5 self-start">
            <i data-lucide="plus" class="w-4 h-4"></i> Create New Flight
        </a>
    </div>

    <!-- Filter Bar -->
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-200/80 mb-6">
        <form method="GET" action="{{ route('admin.flights.index') }}" class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Flight # (e.g. K6-818)" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
            <select name="status" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                <option value="">All Statuses</option>
                <option value="Scheduled" {{ request('status') === 'Scheduled' ? 'selected' : '' }}>Scheduled</option>
                <option value="Boarding" {{ request('status') === 'Boarding' ? 'selected' : '' }}>Boarding</option>
                <option value="Departed" {{ request('status') === 'Departed' ? 'selected' : '' }}>Departed</option>
                <option value="Arrived" {{ request('status') === 'Arrived' ? 'selected' : '' }}>Arrived</option>
                <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            <select name="airline_id" class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs font-semibold">
                <option value="">All Airlines</option>
                @foreach($airlines as $al)
                    <option value="{{ $al->id }}" {{ request('airline_id') == $al->id ? 'selected' : '' }}>{{ $al->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="py-2 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl">
                Filter Flights
            </button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <th class="p-4">Flight #</th>
                        <th class="p-4">Airline</th>
                        <th class="p-4">Route</th>
                        <th class="p-4">Departure</th>
                        <th class="p-4">Seats (Avail/Total)</th>
                        <th class="p-4">Price</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($flights as $flight)
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-mono font-bold text-blue-600">{{ $flight->flight_number }}</td>
                            <td class="p-4 font-bold text-slate-900">{{ $flight->airline->name }}</td>
                            <td class="p-4">
                                <span class="font-bold text-slate-900">{{ $flight->originAirport->code }}</span>
                                <span class="text-slate-400">&rarr;</span>
                                <span class="font-bold text-slate-900">{{ $flight->destinationAirport->code }}</span>
                            </td>
                            <td class="p-4">
                                {{ \Carbon\Carbon::parse($flight->departure_date)->format('M d, Y') }}
                                <span class="block text-[11px] text-slate-400">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}</span>
                            </td>
                            <td class="p-4">
                                <span class="font-bold {{ $flight->available_seats < 10 ? 'text-amber-600' : 'text-slate-800' }}">{{ $flight->available_seats }}</span> / {{ $flight->total_seats }}
                            </td>
                            <td class="p-4 font-bold text-slate-900">${{ number_format($flight->price, 2) }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold {{ $flight->status === 'Cancelled' ? 'bg-rose-50 text-rose-700' : 'bg-emerald-50 text-emerald-700' }}">
                                    {{ $flight->status }}
                                </span>
                            </td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.flights.edit', $flight) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.flights.destroy', $flight) }}" class="inline-block" onsubmit="return confirm('Delete this flight?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-rose-600 font-bold hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-slate-100">
            {{ $flights->links() }}
        </div>
    </div>
</div>
@endsection
