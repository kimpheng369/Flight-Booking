<?php

namespace App\Policies;

use App\Models\Flight;
use App\Models\User;

class FlightPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Flight $flight): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Flight $flight): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Flight $flight): bool
    {
        return $user->isAdmin();
    }
}
