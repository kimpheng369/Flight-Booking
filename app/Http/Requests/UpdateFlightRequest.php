<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFlightRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
    }

    public function rules(): array
    {
        $flightId = $this->route('flight') ? $this->route('flight')->id : $this->flight;

        return [
            'airline_id' => 'required|exists:airlines,id',
            'aircraft_id' => 'required|exists:aircraft,id',
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id|different:origin_airport_id',
            'flight_number' => ['required', 'string', 'max:20', Rule::unique('flights', 'flight_number')->ignore($flightId)],
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'arrival_date' => 'required|date|after_or_equal:departure_date',
            'arrival_time' => 'required',
            'price' => 'required|numeric|min:0.01',
            'total_seats' => 'required|integer|min:1',
            'available_seats' => 'required|integer|min:0|lte:total_seats',
            'baggage_allowance' => 'required|string|max:50',
            'status' => 'required|in:Scheduled,Boarding,Departed,Arrived,Cancelled',
        ];
    }

    public function messages(): array
    {
        return [
            'destination_airport_id.different' => 'Destination airport cannot be identical to origin airport.',
            'available_seats.lte' => 'Available seats cannot exceed total seat capacity.',
        ];
    }
}
