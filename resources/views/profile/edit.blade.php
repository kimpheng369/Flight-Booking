@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-200/80 space-y-6">
        <div class="border-b border-slate-100 pb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Account Profile</h1>
                <p class="text-xs text-slate-500">Update your account personal information and contact details.</p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 font-bold flex items-center justify-center text-lg">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
        </div>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                    @error('name')
                        <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                    @error('email')
                        <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+855 12 345 678" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-medium focus:ring-2 focus:ring-blue-600 focus:bg-white focus:outline-none">
                    @error('phone')
                        <span class="text-xs font-semibold text-rose-600">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Role -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-600">User Role</label>
                    <input type="text" value="{{ ucfirst($user->role) }}" disabled class="w-full px-4 py-3 bg-slate-100 border border-slate-200 rounded-xl text-sm font-bold text-slate-500 cursor-not-allowed">
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-sm rounded-xl shadow-md transition-all flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Save Changes</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
