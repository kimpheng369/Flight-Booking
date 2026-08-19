<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'airline_id',
        'aircraft_id',
        'origin_airport_id',
        'destination_airport_id',
        'flight_number',
        'departure_date',
        'departure_time',
        'arrival_date',
        'arrival_time',
        'price',
        'total_seats',
        'available_seats',
        'baggage_allowance',
        'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'arrival_date' => 'date',
        'price' => 'decimal:2',
        'total_seats' => 'integer',
        'available_seats' => 'integer',
    ];

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }

    public function aircraft(): BelongsTo
    {
        return $this->belongsTo(Aircraft::class);
    }

    public function originAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'origin_airport_id');
    }

    public function destinationAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'destination_airport_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function getDurationAttribute(): string
    {
        try {
            $depString = $this->departure_date->format('Y-m-d') . ' ' . $this->departure_time;
            $arrString = $this->arrival_date->format('Y-m-d') . ' ' . $this->arrival_time;
            $dep = Carbon::parse($depString);
            $arr = Carbon::parse($arrString);
            $minutes = $dep->diffInMinutes($arr);
            $hours = floor($minutes / 60);
            $mins = $minutes % 60;
            return "{$hours}h {$mins}m";
        } catch (\Exception $e) {
            return 'N/A';
        }
    }
}
