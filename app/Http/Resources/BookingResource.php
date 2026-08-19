<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'booking_reference' => $this->booking_reference,
            'flight' => new FlightResource($this->whenLoaded('flight')),
            'passenger_name' => $this->passenger ? "{$this->passenger->first_name} {$this->passenger->last_name}" : null,
            'seats' => $this->seats,
            'total_price' => (float) $this->total_price,
            'booking_status' => $this->booking_status,
            'payment_status' => $this->payment_status,
            'booked_at' => $this->booked_at ? $this->booked_at->toIso8601String() : null,
        ];
    }
}
