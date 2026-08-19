@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-6">
        <a href="{{ route('admin.aircraft.index') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Fleet
        </a>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Edit Aircraft: {{ $aircraft->registration_number }}</h1>

        <form method="POST" action="{{ route('admin.aircraft.update', $aircraft) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Airline Owner</label>
                <select name="airline_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                    @foreach($airlines as $al)
                        <option value="{{ $al->id }}" {{ $aircraft->airline_id == $al->id ? 'selected' : '' }}>{{ $al->name }} ({{ $al->code }})</option>
                    @endforeach
                </select>
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Aircraft Model</label>
                <input type="text" name="model" value="{{ old('model', $aircraft->model) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Registration Number</label>
                <input type="text" name="registration_number" value="{{ old('registration_number', $aircraft->registration_number) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold uppercase">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Seat Capacity</label>
                <input type="number" name="seat_capacity" value="{{ old('seat_capacity', $aircraft->seat_capacity) }}" min="1" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold">
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Update Aircraft
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
