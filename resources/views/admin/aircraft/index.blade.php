@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Aircraft Fleet Management</h1>
            <p class="text-xs text-slate-500">Manage commercial airplanes, models and seat capacities.</p>
        </div>
        <a href="{{ route('admin.aircraft.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-1.5 self-start">
            <i data-lucide="plus" class="w-4 h-4"></i> Register New Aircraft
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <th class="p-4">Reg #</th>
                        <th class="p-4">Model</th>
                        <th class="p-4">Operating Airline</th>
                        <th class="p-4">Seat Capacity</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($aircrafts as $aircraft)
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-mono font-bold text-blue-600">{{ $aircraft->registration_number }}</td>
                            <td class="p-4 font-bold text-slate-900">{{ $aircraft->model }}</td>
                            <td class="p-4 text-slate-700">{{ $aircraft->airline->name }} ({{ $aircraft->airline->code }})</td>
                            <td class="p-4 font-bold text-slate-800">{{ $aircraft->seat_capacity }} Seats</td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.aircraft.edit', $aircraft) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.aircraft.destroy', $aircraft) }}" class="inline-block" onsubmit="return confirm('Delete this aircraft?');">
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
            {{ $aircrafts->links() }}
        </div>
    </div>
</div>
@endsection
