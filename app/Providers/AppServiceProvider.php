<?php

namespace App\Providers;

use App\Models\Airport;
use App\Services\RealTimeAirportApiService;
use App\Services\RealTimeFlightGeneratorService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Real-Time API Auto-Initializer: If database is unseeded, auto-fetch from Live Airport API
        try {
            if (Schema::hasTable('airports') && Airport::count() === 0) {
                (new RealTimeAirportApiService())->syncLiveAirports(250);
                (new RealTimeFlightGeneratorService())->generateLiveSchedules();
            }
        } catch (\Throwable $e) {
            // Ignore during migrations
        }
    }
}
