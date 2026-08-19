@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="mb-6">
        <a href="{{ route('admin.airlines.index') }}" class="text-xs font-bold text-slate-500 hover:text-blue-600 flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Back to Airlines
        </a>
    </div>

    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
        <h1 class="text-2xl font-extrabold text-slate-900">Add New Airline</h1>

        <form method="POST" action="{{ route('admin.airlines.store') }}" class="space-y-4">
            @csrf

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Airline Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Cambodia Angkor Air" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
                @error('name') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">IATA Code (2 Chars)</label>
                <input type="text" name="code" value="{{ old('code') }}" required placeholder="e.g. K6" maxlength="5" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-bold uppercase">
                @error('code') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Country</label>
                <input type="text" name="country" value="{{ old('country') }}" required placeholder="e.g. Cambodia" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold">
            </div>

            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Logo Image URL (Optional)</label>
                <input type="url" name="logo" value="{{ old('logo') }}" placeholder="https://..." class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium">
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md">
                    Save Airline
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
