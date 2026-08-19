@extends('layouts.app')

@section('content')
<div class="min-h-[75vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white rounded-3xl p-8 shadow-xl border border-slate-200/80 space-y-6">
        <div class="text-center space-y-2">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center mx-auto mb-3">
                <i data-lucide="user-plus" class="w-6 h-6"></i>
            </div>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Create Customer Account</h2>
            <p class="text-xs text-slate-500">Join SkyBook to search, book and manage your flight tickets.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <!-- Full Name -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                @error('name')
                    <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                @error('email')
                    <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Phone -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Phone Number (Optional)</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="+855 12 345 678" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                @error('phone')
                    <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Password</label>
                <input type="password" name="password" required placeholder="At least 8 characters" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                @error('password')
                    <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Confirm Password</label>
                <input type="password" name="password_confirmation" required placeholder="Repeat password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/50 transition-all flex items-center justify-center gap-2">
                <span>Create Account</span>
                <i data-lucide="check" class="w-4 h-4"></i>
            </button>
        </form>

        <div class="text-center text-xs text-slate-500 border-t border-slate-100 pt-4">
            Already have an account? <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:underline">Sign In</a>
        </div>
    </div>
</div>
@endsection
