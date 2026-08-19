<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$service = new App\Services\AirportApiService();
$query = App\Models\Airport::where(function ($query) {
    $query->where('code', 'like', '%Paris%')
        ->orWhere('name', 'like', '%Paris%')
        ->orWhere('city', 'like', '%Paris%')
        ->orWhere('country', 'like', '%Paris%');
});

echo "SQL: " . $query->toSql() . "\n";
echo "BINDINGS: " . json_encode($query->getBindings()) . "\n";
echo "COUNT: " . $query->count() . "\n";
