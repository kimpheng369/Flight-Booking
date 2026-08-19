@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Airport Management</h1>
            <p class="text-xs text-slate-500">Manage global airports, hubs, and IATA location codes.</p>
        </div>
        <a href="{{ route('admin.airports.create') }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-1.5 self-start">
            <i data-lucide="plus" class="w-4 h-4"></i> Add New Airport
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <th class="p-4">IATA Code</th>
                        <th class="p-4">Airport Name</th>
                        <th class="p-4">City</th>
                        <th class="p-4">Country</th>
                        <th class="p-4">Timezone</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium">
                    @foreach($airports as $airport)
                        <tr class="hover:bg-slate-50/50">
                            <td class="p-4 font-mono font-bold text-blue-600">{{ $airport->code }}</td>
                            <td class="p-4 font-bold text-slate-900">{{ $airport->name }}</td>
                            <td class="p-4 text-slate-700">{{ $airport->city }}</td>
                            <td class="p-4 text-slate-700">{{ $airport->country }}</td>
                            <td class="p-4 text-slate-500 font-mono">{{ $airport->timezone }}</td>
                            <td class="p-4 text-right space-x-2">
                                <a href="{{ route('admin.airports.edit', $airport) }}" class="text-blue-600 font-bold hover:underline">Edit</a>
                                <form method="POST" action="{{ route('admin.airports.destroy', $airport) }}" class="inline-block" onsubmit="return confirm('Delete this airport?');">
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
            {{ $airports->links() }}
        </div>
    </div>
</div>
@endsection
