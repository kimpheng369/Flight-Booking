<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'logo',
        'country',
    ];

    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class);
    }

    public function aircraft(): HasMany
    {
        return $this->hasMany(Aircraft::class);
    }
}
