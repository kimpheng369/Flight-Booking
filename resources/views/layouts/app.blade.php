<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SkyBook') }} — Flight Booking System</title>
    <meta name="description" content="Search, compare and book flights easily with SkyBook airline booking platform.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN Fallback + Lucide Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        skybook: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Chart.js for Admin Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="font-sans antialiased text-slate-800 bg-slate-50 min-h-full flex flex-col justify-between selection:bg-blue-600 selection:text-white">

    <!-- Main Navigation Bar -->
    <nav class="bg-slate-900/95 backdrop-blur-xl border-b border-slate-800/80 sticky top-0 z-50 transition-all shadow-xl shadow-slate-950/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-10">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-blue-600 via-sky-500 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-500/30 ring-2 ring-sky-400/30 group-hover:scale-105 transition-all duration-300">
                            <i data-lucide="plane" class="w-6 h-6 -rotate-45 group-hover:rotate-0 transition-transform duration-500"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black tracking-tight text-white leading-none">Sky<span class="bg-gradient-to-r from-sky-400 to-blue-500 bg-clip-text text-transparent">Book</span></span>
                            <span class="text-[9px] uppercase font-extrabold tracking-widest text-slate-400 mt-1">Airlines & Hubs</span>
                        </div>
                    </a>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center gap-1.5 text-sm font-semibold">
                        <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl transition-all flex items-center gap-2 {{ request()->routeIs('home') ? 'bg-blue-600/20 text-sky-400 border border-sky-500/30 shadow-inner' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                            <i data-lucide="compass" class="w-4 h-4"></i>
                            <span>Home</span>
                        </a>

                        <a href="{{ route('flights.index') }}" class="px-4 py-2 rounded-xl transition-all flex items-center gap-2 {{ request()->routeIs('flights.*') ? 'bg-blue-600/20 text-sky-400 border border-sky-500/30 shadow-inner' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span>Search Flights</span>
                        </a>

                        @auth
                            <a href="{{ route('bookings.index') }}" class="px-4 py-2 rounded-xl transition-all flex items-center gap-2 {{ request()->routeIs('bookings.*') ? 'bg-blue-600/20 text-sky-400 border border-sky-500/30 shadow-inner' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                                <i data-lucide="ticket" class="w-4 h-4"></i>
                                <span>My Bookings</span>
                            </a>

                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-xl transition-all flex items-center gap-2 {{ request()->routeIs('dashboard') ? 'bg-blue-600/20 text-sky-400 border border-sky-500/30 shadow-inner' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                                <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                                <span>Dashboard</span>
                            </a>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="ml-2 px-3.5 py-1.5 bg-amber-500/10 text-amber-400 border border-amber-500/30 hover:bg-amber-500/20 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 shadow-sm shadow-amber-500/10">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-amber-400"></i>
                                    <span>Admin Panel</span>
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Right Action Buttons -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-3">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3.5 py-2 rounded-2xl bg-slate-800/80 border border-slate-700/80 hover:border-slate-600 hover:bg-slate-800 transition-all group">
                                <div class="relative">
                                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-blue-600 to-sky-400 text-white font-black flex items-center justify-center text-xs shadow-md shadow-blue-500/20">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                    </div>
                                    <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-400 ring-2 ring-slate-900"></span>
                                </div>
                                <div class="text-left hidden lg:block">
                                    <span class="block text-xs font-bold text-slate-100 group-hover:text-sky-400 transition-colors leading-tight">{{ auth()->user()->name }}</span>
                                    <span class="block text-[10px] font-semibold text-slate-400 capitalize">{{ auth()->user()->role }}</span>
                                </div>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="p-2.5 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 border border-transparent hover:border-rose-500/20 transition-all" title="Logout">
                                    <i data-lucide="log-out" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-300 hover:text-white px-4 py-2.5 rounded-xl hover:bg-slate-800 transition">Sign In</a>
                        <a href="{{ route('register') }}" class="text-sm font-bold text-white bg-gradient-to-r from-blue-600 to-sky-500 hover:from-blue-500 hover:to-sky-400 px-5 py-2.5 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-500/50 hover:scale-[1.02] transition-all duration-300 flex items-center gap-2">
                            <span>Register</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" type="button" class="p-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 border border-slate-700">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-800 bg-slate-900 px-4 pt-3 pb-6 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold text-slate-200 hover:bg-slate-800">Home</a>
            <a href="{{ route('flights.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold text-slate-200 hover:bg-slate-800">Search Flights</a>
            @auth
                <a href="{{ route('bookings.index') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold text-slate-200 hover:bg-slate-800">My Bookings</a>
                <a href="{{ route('dashboard') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold text-slate-200 hover:bg-slate-800">Dashboard</a>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2.5 rounded-lg text-base font-semibold text-amber-400 bg-amber-500/10">Admin Panel</a>
                @endif
                <div class="pt-3 border-t border-slate-800 flex items-center justify-between">
                    <span class="text-sm font-semibold text-white">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-rose-400 font-semibold hover:underline">Log Out</button>
                    </form>
                </div>
            @else
                <div class="pt-3 border-t border-slate-800 flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="text-center w-full py-2.5 font-semibold text-slate-200 bg-slate-800 rounded-xl">Sign In</a>
                    <a href="{{ route('register') }}" class="text-center w-full py-2.5 font-semibold text-white bg-blue-600 rounded-xl shadow-md">Register</a>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0">
                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    </div>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center justify-between shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-rose-500 text-white flex items-center justify-center shrink-0">
                        <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    </div>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Page Content -->
    <main class="flex-grow">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-12 mt-20 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                <div class="space-y-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center text-white">
                            <i data-lucide="plane" class="w-5 h-5 -rotate-45"></i>
                        </div>
                        <span class="text-xl font-extrabold tracking-tight text-white">Sky<span class="text-blue-500">Book</span></span>
                    </a>
                    <p class="text-sm text-slate-400 leading-relaxed">
                        Search, compare and book flights seamlessly with SkyBook's modern flight platform.
                    </p>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition">Home</a></li>
                        <li><a href="{{ route('flights.index') }}" class="hover:text-white transition">Search Flights</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Sign In</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Create Account</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Popular Hubs</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><span class="hover:text-white transition cursor-default">Phnom Penh (PNH)</span></li>
                        <li><span class="hover:text-white transition cursor-default">Singapore Changi (SIN)</span></li>
                        <li><span class="hover:text-white transition cursor-default">Bangkok Suvarnabhumi (BKK)</span></li>
                        <li><span class="hover:text-white transition cursor-default">Ho Chi Minh City (SGN)</span></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Contact & Support</h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-3 text-slate-400">
                            <i data-lucide="mail" class="w-4 h-4 text-blue-500"></i> support@skybook.test
                        </li>
                        <li class="flex items-center gap-3 text-slate-400">
                            <i data-lucide="phone" class="w-4 h-4 text-blue-500"></i> +855 23 999 888
                        </li>
                        <li class="flex items-center gap-3 text-slate-400">
                            <i data-lucide="map-pin" class="w-4 h-4 text-blue-500"></i> SkyBook Aviation Tower, Phnom Penh
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} SkyBook — Flight Booking System. Built with Laravel 13 & Tailwind CSS.</p>
                <div class="flex gap-6">
                    <span>Privacy Policy</span>
                    <span>Terms of Service</span>
                    <span>Student Portfolio Project</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
