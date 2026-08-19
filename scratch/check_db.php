<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = new App\Services\AirportApiService();
$results = $service->search('Paris');

echo "Total results for Paris: " . $results->count() . "\n";
foreach ($results as $ap) {
    echo "Code: {$ap->code} | City: {$ap->city} | Country: {$ap->country}\n";
}
