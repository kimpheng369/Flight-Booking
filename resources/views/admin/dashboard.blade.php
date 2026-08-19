@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-amber-600 flex items-center gap-1.5">
                <i data-lucide="shield-check" class="w-4 h-4"></i> System Control Center
            </span>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight mt-1">Admin Dashboard</h1>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('admin.flights.create') }}" class="px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-1.5">
                <i data-lucide="plus" class="w-4 h-4"></i> Add Flight
            </a>
            <a href="{{ route('admin.airports.create') }}" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs rounded-xl shadow-md flex items-center gap-1.5">
                <i data-lucide="plus" class="w-4 h-4"></i> Add Airport
            </a>
        </div>
    </div>

    <!-- Admin Navigation Tabs -->
    <div class="flex flex-wrap items-center gap-2 border-b border-slate-200 pb-4 mb-8">
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-amber-500 text-white font-bold text-xs rounded-xl shadow-sm">Overview</a>
        <a href="{{ route('admin.flights.index') }}" class="px-4 py-2 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl border border-slate-200">Flights</a>
        <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl border border-slate-200">Bookings</a>
        <a href="{{ route('admin.airlines.index') }}" class="px-4 py-2 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl border border-slate-200">Airlines</a>
        <a href="{{ route('admin.airports.index') }}" class="px-4 py-2 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl border border-slate-200">Airports</a>
        <a href="{{ route('admin.aircraft.index') }}" class="px-4 py-2 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs rounded-xl border border-slate-200">Aircraft</a>
    </div>

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-10">
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/80 space-y-1">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Users</span>
            <div class="text-2xl font-black text-slate-900">{{ $totalUsers }}</div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/80 space-y-1">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Flights</span>
            <div class="text-2xl font-black text-slate-900">{{ $totalFlights }}</div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/80 space-y-1">
            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Bookings</span>
            <div class="text-2xl font-black text-slate-900">{{ $totalBookings }}</div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/80 space-y-1">
            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">Confirmed</span>
            <div class="text-2xl font-black text-emerald-700">{{ $confirmedBookings }}</div>
        </div>
        <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-200/80 space-y-1">
            <span class="text-[10px] font-bold uppercase tracking-wider text-rose-600">Cancelled</span>
            <div class="text-2xl font-black text-rose-700">{{ $cancelledBookings }}</div>
        </div>
        <div class="bg-gradient-to-br from-blue-900 to-slate-900 text-white rounded-2xl p-5 shadow-md space-y-1">
            <span class="text-[10px] font-bold uppercase tracking-wider text-blue-300">Total Revenue</span>
            <div class="text-2xl font-black text-white">${{ number_format($totalRevenue, 2) }}</div>
        </div>
    </div>

    <!-- Chart.js 4-Grid Analytics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
        <!-- Chart 1: Bookings per Month -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
            <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                <i data-lucide="trending-up" class="w-4 h-4 text-blue-600"></i> Bookings Trend (Per Month)
            </h3>
            <div class="h-64">
                <canvas id="bookingsChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Revenue per Month -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
            <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                <i data-lucide="dollar-sign" class="w-4 h-4 text-emerald-600"></i> Monthly Revenue ($)
            </h3>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Chart 3: Popular Destinations -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
            <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4 text-indigo-600"></i> Top Popular Destinations
            </h3>
            <div class="h-64 flex justify-center">
                <canvas id="destinationsChart"></canvas>
            </div>
        </div>

        <!-- Chart 4: Status Distribution -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-slate-200/80 space-y-4">
            <h3 class="text-base font-extrabold text-slate-900 flex items-center gap-2">
                <i data-lucide="pie-chart" class="w-4 h-4 text-amber-600"></i> Booking Status Distribution
            </h3>
            <div class="h-64 flex justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const monthLabels = @json($months);
        const bookingsData = @json($monthlyBookingsData);
        const revenueData = @json($monthlyRevenueData);

        const popularDestinations = @json($popularDestinations);
        const destLabels = popularDestinations.map(d => d.city);
        const destCounts = popularDestinations.map(d => d.booking_count);

        const statusDist = @json($statusDistribution);

        // Chart 1: Bookings Line Chart
        new Chart(document.getElementById('bookingsChart'), {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Bookings',
                    data: bookingsData,
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.1)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Chart 2: Revenue Bar Chart
        new Chart(document.getElementById('revenueChart'), {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Revenue ($)',
                    data: revenueData,
                    backgroundColor: '#10b981',
                    borderRadius: 8
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Chart 3: Destinations Doughnut
        new Chart(document.getElementById('destinationsChart'), {
            type: 'doughnut',
            data: {
                labels: destLabels,
                datasets: [{
                    data: destCounts,
                    backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Chart 4: Status Distribution Pie
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(statusDist),
                datasets: [{
                    data: Object.values(statusDist),
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#f43f5e']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    });
</script>
@endsection
