<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'flight_number' => $this->flight_number,
            'airline' => new AirlineResource($this->whenLoaded('airline')),
            'origin' => new AirportResource($this->whenLoaded('originAirport')),
            'destination' => new AirportResource($this->whenLoaded('destinationAirport')),
            'departure_date' => $this->departure_date ? $this->departure_date->format('Y-m-d') : null,
            'departure_time' => $this->departure_time,
            'arrival_date' => $this->arrival_date ? $this->arrival_date->format('Y-m-d') : null,
            'arrival_time' => $this->arrival_time,
            'duration' => $this->duration,
            'price' => (float) $this->price,
            'total_seats' => $this->total_seats,
            'available_seats' => $this->available_seats,
            'status' => $this->status,
        ];
    }
}
