<?php

namespace App\Services;

use App\Models\Airport;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RealTimeAirportApiService
{
    /**
     * Live API source URL for 28,000+ real world airports.
     */
    protected string $liveApiUrl = 'https://raw.githubusercontent.com/mwgg/Airports/master/airports.json';

    /**
     * Priority IATA codes for major global hubs to guarantee immediate availability.
     */
    protected array $priorityCodes = [
        'PNH', 'SAI', 'KOS', 'SIN', 'BKK', 'JFK', 'CDG', 'HND', 'NRT', 'LHR', 
        'DXB', 'KUL', 'LAX', 'SFO', 'FRA', 'AMS', 'ICN', 'HKG', 'SYD', 'SGN'
    ];

    /**
     * Fetch real airports live from online API and sync into local database.
     */
    public function syncLiveAirports(int $maxImport = 500): int
    {
        try {
            $response = Http::withoutVerifying()->timeout(15)->get($this->liveApiUrl);

            if (! $response->successful()) {
                Log::warning("Failed to fetch live airport API. Status: " . $response->status());
                return 0;
            }

            $airportsData = $response->json();
            $importedCount = 0;

            // Country code mapping dictionary
            $countryNames = [
                'KH' => 'Cambodia',
                'US' => 'United States',
                'FR' => 'France',
                'JP' => 'Japan',
                'SG' => 'Singapore',
                'TH' => 'Thailand',
                'GB' => 'United Kingdom',
                'DE' => 'Germany',
                'NL' => 'Netherlands',
                'AE' => 'United Arab Emirates',
                'QA' => 'Qatar',
                'MY' => 'Malaysia',
                'VN' => 'Vietnam',
                'ID' => 'Indonesia',
                'KR' => 'South Korea',
                'CN' => 'China',
                'AU' => 'Australia',
                'CA' => 'Canada',
            ];

            // City normalization dictionary for major hubs
            $cityMap = [
                'CDG' => 'Paris',
                'JFK' => 'New York',
                'HND' => 'Tokyo',
                'NRT' => 'Tokyo',
                'LHR' => 'London',
                'PNH' => 'Phnom Penh',
                'SAI' => 'Siem Reap',
                'KOS' => 'Sihanoukville',
                'BKK' => 'Bangkok',
                'SIN' => 'Singapore',
                'DXB' => 'Dubai',
                'KUL' => 'Kuala Lumpur',
                'LAX' => 'Los Angeles',
                'SGN' => 'Ho Chi Minh City',
                'ICN' => 'Seoul',
            ];

            // Step 1: Import priority major hubs first by checking $data['iata']
            foreach ($airportsData as $icao => $data) {
                $iata = strtoupper($data['iata'] ?? '');
                if (in_array($iata, $this->priorityCodes)) {
                    $countryCode = strtoupper(trim($data['country'] ?? ''));
                    $country = $countryNames[$countryCode] ?? $countryCode;
                    $city = $cityMap[$iata] ?? ($data['city'] ?? $data['name']);

                    Airport::updateOrCreate(
                        ['code' => $iata],
                        [
                            'name' => substr($data['name'], 0, 150),
                            'city' => substr($city, 0, 100),
                            'country' => substr($country, 0, 100),
                            'timezone' => $data['tz'] ?? 'UTC',
                        ]
                    );
                    $importedCount++;
                }
            }

            // Step 2: Import additional live airports up to maxImport limit
            foreach ($airportsData as $icao => $data) {
                if ($importedCount >= $maxImport) {
                    break;
                }

                $code = strtoupper($data['iata'] ?? '');
                if (empty($code) || in_array($code, $this->priorityCodes)) {
                    continue;
                }

                if (
                    strlen($code) === 3 && 
                    ! empty($data['city']) && 
                    ! empty($data['country']) && 
                    ! empty($data['name'])
                ) {
                    $countryCode = strtoupper(trim($data['country']));
                    $country = $countryNames[$countryCode] ?? $countryCode;
                    $city = $cityMap[$code] ?? $data['city'];

                    // In Cambodia, strictly enforce ONLY the 3 major commercial operational airports: PNH, SAI, KOS
                    if (($country === 'Cambodia' || $countryCode === 'KH') && ! in_array($code, ['PNH', 'SAI', 'KOS'])) {
                        continue;
                    }

                    Airport::updateOrCreate(
                        ['code' => $code],
                        [
                            'name' => substr($data['name'], 0, 150),
                            'city' => substr($city, 0, 100),
                            'country' => substr($country, 0, 100),
                            'timezone' => $data['tz'] ?? 'UTC',
                        ]
                    );

                    $importedCount++;
                }
            }

            return $importedCount;

        } catch (\Throwable $e) {
            Log::error("RealTimeAirportApiService Exception: " . $e->getMessage());
            return 0;
        }
    }
}
