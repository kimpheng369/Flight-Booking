<?php

namespace App\Services;

use App\Models\Airport;
use Illuminate\Database\Eloquent\Collection;

class AirportApiService
{
    /**
     * Search real airports by name, IATA code, city, or country.
     */
    public function search(string $term, int $limit = 30): Collection
    {
        $term = trim($term);
        return Airport::where(function ($query) use ($term) {
            $query->where('code', 'like', "%{$term}%")
                ->orWhere('name', 'like', "%{$term}%")
                ->orWhere('city', 'like', "%{$term}%")
                ->orWhere('country', 'like', "%{$term}%");
        })
        ->orderBy('city')
        ->take($limit)
        ->get();
    }

    /**
     * Get all registered airports ordered by country and city.
     */
    public function getAll(): Collection
    {
        return Airport::orderBy('country')->orderBy('city')->get();
    }
}
