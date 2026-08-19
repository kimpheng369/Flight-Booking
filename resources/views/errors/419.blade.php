@extends('layouts.app')

@section('content')
<div class="min-h-[65vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center space-y-6">
        <div class="w-24 h-24 mx-auto bg-purple-50 text-purple-600 rounded-3xl flex items-center justify-center shadow-inner">
            <i data-lucide="clock" class="w-12 h-12"></i>
        </div>
        <div class="space-y-2">
            <span class="text-xs font-bold tracking-widest text-purple-600 uppercase">419 Session Expired</span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Page Expired</h1>
            <p class="text-sm text-slate-500">Your session has timed out due to inactivity. Please refresh and try again.</p>
        </div>
        <div>
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-xl transition-all">
                <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                <span>Refresh & Retry</span>
            </a>
        </div>
    </div>
</div>
@endsection
