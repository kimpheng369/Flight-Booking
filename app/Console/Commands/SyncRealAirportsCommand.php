<?php

namespace App\Console\Commands;

use App\Services\RealTimeAirportApiService;
use Illuminate\Console\Command;

class SyncRealAirportsCommand extends Command
{
    protected $signature = 'skybook:sync-airports {--limit=200 : Maximum number of real airports to sync}';
    protected $description = 'Sync live real-time world airport data from online API';

    public function handle(RealTimeAirportApiService $apiService): int
    {
        $limit = (int) $this->option('limit');
        $this->info("Fetching live real-time airport dataset from online API...");

        $count = $apiService->syncLiveAirports($limit);

        if ($count > 0) {
            $this->info("Successfully synced {$count} real world airports into database.");
            return Command::SUCCESS;
        }

        $this->error("Failed to sync live airports from API.");
        return Command::FAILURE;
    }
}
