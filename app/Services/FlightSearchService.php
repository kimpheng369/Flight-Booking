<?php

namespace App\Services;

use App\Models\Flight;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class FlightSearchService
{
    /**
     * Search and filter flights using Eloquent Database Queries (no in-memory PHP filtering).
     */
    public function search(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        $query = Flight::with(['airline', 'aircraft', 'originAirport', 'destinationAirport'])
            ->where('status', '!=', 'Cancelled');

        // Filter origin airport (by code or ID)
        if (!empty($filters['origin'])) {
            $origin = $filters['origin'];
            $query->whereHas('originAirport', function (Builder $q) use ($origin) {
                $q->where('code', $origin)->orWhere('city', 'like', "%{$origin}%")->orWhere('id', $origin);
            });
        }

        // Filter destination airport
        if (!empty($filters['destination'])) {
            $dest = $filters['destination'];
            $query->whereHas('destinationAirport', function (Builder $q) use ($dest) {
                $q->where('code', $dest)->orWhere('city', 'like', "%{$dest}%")->orWhere('id', $dest);
            });
        }

        // Filter departure date
        if (!empty($filters['departure_date'])) {
            $query->whereDate('departure_date', $filters['departure_date']);
        }

        // Filter available seats requirement
        $passengers = (int) ($filters['passengers'] ?? 1);
        if ($passengers > 0) {
            $query->where('available_seats', '>=', $passengers);
        }

        // Filter by airline ID
        if (!empty($filters['airline_id'])) {
            $query->where('airline_id', $filters['airline_id']);
        }

        // Filter price range
        if (isset($filters['price_min']) && $filters['price_min'] !== '') {
            $query->where('price', '>=', (float) $filters['price_min']);
        }
        if (isset($filters['price_max']) && $filters['price_max'] !== '') {
            $query->where('price', '<=', (float) $filters['price_max']);
        }

        // Filter departure time range (morning, afternoon, evening)
        if (!empty($filters['time_range'])) {
            switch ($filters['time_range']) {
                case 'morning':
                    $query->whereTime('departure_time', '>=', '05:00:00')->whereTime('departure_time', '<', '12:00:00');
                    break;
                case 'afternoon':
                    $query->whereTime('departure_time', '>=', '12:00:00')->whereTime('departure_time', '<', '18:00:00');
                    break;
                case 'evening':
                    $query->whereTime('departure_time', '>=', '18:00:00');
                    break;
            }
        }

        // Sorting
        $sortBy = $filters['sort_by'] ?? 'departure';
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'seats':
                $query->orderBy('available_seats', 'desc');
                break;
            case 'departure':
            default:
                $query->orderBy('departure_date', 'asc')->orderBy('departure_time', 'asc');
                break;
        }

        return $query->paginate($perPage)->withQueryString();
    }
}
