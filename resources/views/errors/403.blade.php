@extends('layouts.app')

@section('content')
<div class="min-h-[65vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center space-y-6">
        <div class="w-24 h-24 mx-auto bg-amber-50 text-amber-600 rounded-3xl flex items-center justify-center shadow-inner">
            <i data-lucide="shield-alert" class="w-12 h-12"></i>
        </div>
        <div class="space-y-2">
            <span class="text-xs font-bold tracking-widest text-amber-600 uppercase">403 Access Denied</span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Restricted Area</h1>
            <p class="text-sm text-slate-500">You do not have the required permissions to access this page or resource.</p>
        </div>
        <div>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl transition-all">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Back to Home</span>
            </a>
        </div>
    </div>
</div>
@endsection
