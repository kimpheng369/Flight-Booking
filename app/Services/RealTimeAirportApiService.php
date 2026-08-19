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

            $countryNames = [
                'KH' => 'Cambodia', 'US' => 'United States', 'FR' => 'France',
                'JP' => 'Japan', 'SG' => 'Singapore', 'TH' => 'Thailand',
                'GB' => 'United Kingdom', 'DE' => 'Germany', 'NL' => 'Netherlands',
                'AE' => 'United Arab Emirates', 'QA' => 'Qatar', 'MY' => 'Malaysia',
                'VN' => 'Vietnam', 'ID' => 'Indonesia', 'KR' => 'South Korea',
                'CN' => 'China', 'AU' => 'Australia', 'CA' => 'Canada',
            ];

            $cityMap = [
                'CDG' => 'Paris', 'JFK' => 'New York', 'HND' => 'Tokyo',
                'NRT' => 'Tokyo', 'LHR' => 'London', 'PNH' => 'Phnom Penh',
                'SAI' => 'Siem Reap', 'KOS' => 'Sihanoukville', 'BKK' => 'Bangkok',
                'SIN' => 'Singapore', 'DXB' => 'Dubai', 'KUL' => 'Kuala Lumpur',
                'LAX' => 'Los Angeles', 'SGN' => 'Ho Chi Minh City', 'ICN' => 'Seoul',
            ];

            $rows = [];
            $now = now()->toDateTimeString();

            // Step 1: Priority hubs first
            foreach ($airportsData as $icao => $data) {
                $iata = strtoupper($data['iata'] ?? '');
                if (in_array($iata, $this->priorityCodes)) {
                    $countryCode = strtoupper(trim($data['country'] ?? ''));
                    $rows[$iata] = [
                        'code'       => $iata,
                        'name'       => substr($data['name'], 0, 150),
                        'city'       => substr($cityMap[$iata] ?? ($data['city'] ?? $data['name']), 0, 100),
                        'country'    => substr($countryNames[$countryCode] ?? $countryCode, 0, 100),
                        'timezone'   => $data['tz'] ?? 'UTC',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }

            // Step 2: Fill up to maxImport
            foreach ($airportsData as $icao => $data) {
                if (count($rows) >= $maxImport) break;

                $code = strtoupper($data['iata'] ?? '');
                if (empty($code) || strlen($code) !== 3 || isset($rows[$code])) continue;
                if (empty($data['city']) || empty($data['country']) || empty($data['name'])) continue;

                $countryCode = strtoupper(trim($data['country']));
                $country = $countryNames[$countryCode] ?? $countryCode;

                // Only allow the 3 major Cambodian airports
                if (($country === 'Cambodia' || $countryCode === 'KH') && !in_array($code, ['PNH', 'SAI', 'KOS'])) {
                    continue;
                }

                $rows[$code] = [
                    'code'       => $code,
                    'name'       => substr($data['name'], 0, 150),
                    'city'       => substr($cityMap[$code] ?? $data['city'], 0, 100),
                    'country'    => substr($country, 0, 100),
                    'timezone'   => $data['tz'] ?? 'UTC',
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }

            // Bulk upsert in chunks of 50
            foreach (array_chunk(array_values($rows), 50) as $chunk) {
                Airport::upsert($chunk, ['code'], ['name', 'city', 'country', 'timezone', 'updated_at']);
            }

            return count($rows);

        } catch (\Throwable $e) {
            Log::error("RealTimeAirportApiService Exception: " . $e->getMessage());
            return 0;
        }
    }
}
