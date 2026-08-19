<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'flight_id' => 'required|exists:flights,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:Male,Female',
            'date_of_birth' => 'required|date',
            'passport_number' => 'required|string|max:50',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:255',
            'seats' => 'required|integer|min:1|max:9',
        ];
    }
}
