<?php

namespace App\Console\Commands;

use App\Services\RealTimeFlightGeneratorService;
use Illuminate\Console\Command;

class GenerateRealTimeFlightsCommand extends Command
{
    protected $signature = 'skybook:generate-flights';
    protected $description = 'Generate real-time live flight schedules for synced airports';

    public function handle(RealTimeFlightGeneratorService $generatorService): int
    {
        $this->info("Generating live flight schedules for real airports...");
        $count = $generatorService->generateLiveSchedules();

        $this->info("Generated {$count} real-time flight schedules.");
        return Command::SUCCESS;
    }
}
