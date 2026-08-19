@extends('layouts.app')

@section('content')
<div class="min-h-[65vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center space-y-6">
        <div class="w-24 h-24 mx-auto bg-blue-50 text-blue-600 rounded-3xl flex items-center justify-center shadow-inner">
            <i data-lucide="compass" class="w-12 h-12"></i>
        </div>
        <div class="space-y-2">
            <span class="text-xs font-bold tracking-widest text-blue-600 uppercase">404 Error</span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Destination Not Found</h1>
            <p class="text-sm text-slate-500">The page or flight destination you are looking for has taken off or doesn't exist.</p>
        </div>
        <div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl shadow-lg shadow-blue-600/20 transition-all">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Return to Home</span>
            </a>
        </div>
    </div>
</div>
@endsection
