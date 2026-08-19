@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Airline Management</h1>
            <p class="text-xs text-slate-500">Manage commercial airline partners and carriers.</p>
        </div>
        <a href="{{ route('admin.airlines.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-1.5 self-start">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Airline
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <th class="p-4">Code</th>
                        <th class="p-4">Airline Name</th>
                        <th class="p-4">Country</th>
                        <th class="p-4">Fleet Count</th>
                        <th class="p-4">Active Flights</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($airlines as $airline)
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-mono font-bold text-blue-600">{{ $airline->code }}</td>
                            <td class="p-4 font-bold text-slate-900 flex items-center gap-2">
                                <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-700 font-bold flex items-center justify-center text-[10px]">
                                    {{ $airline->code }}
                                </div>
                                <span>{{ $airline->name }}</span>
                            </td>
                            <td class="p-4 text-slate-700">{{ $airline->country }}</td>
                            <td class="p-4 font-bold text-slate-800">{{ $airline->aircraft_count }}</td>
                            <td class="p-4 font-bold text-slate-800">{{ $airline->flights_count }}</td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.airlines.edit', $airline) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.airlines.destroy', $airline) }}" class="inline-block" onsubmit="return confirm('Delete this airline?');">
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
            {{ $airlines->links() }}
        </div>
    </div>
</div>
@endsection
