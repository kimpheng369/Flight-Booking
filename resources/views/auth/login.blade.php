@extends('layouts.app')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 shadow-xl border border-slate-200/80 space-y-6">
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-3">
                <i data-lucide="log-in" class="w-6 h-6"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Sign In to SkyBook</h2>
            <p class="text-xs text-slate-500">Manage your flight reservations and access your digital tickets.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <!-- Email -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="name@example.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                @error('email')
                    <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Password</label>
                </div>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                @error('password')
                    <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                    <span class="text-xs font-medium text-slate-600">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all flex items-center justify-center gap-2">
                <span>Sign In</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        <!-- Demo Account Banner -->
        <div class="p-3.5 rounded-2xl bg-amber-50 border border-amber-200/80 text-xs text-amber-900 space-y-1">
            <div class="font-bold flex items-center gap-1.5 text-amber-800">
                <i data-lucide="info" class="w-4 h-4"></i> Demo Credentials
            </div>
            <div class="text-[11px] font-mono">
                Admin: admin@skybook.test / password<br>
                Customer: john@skybook.test / password
            </div>
        </div>

        <div class="text-center text-xs text-slate-500 border-t border-slate-100 pt-4">
            Don't have an account? <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:underline">Register Now</a>
        </div>
    </div>
</div>
@endsection
