<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    public function view(User $user, Booking $booking): bool
    {
        return $user->isAdmin() || $user->id === $booking->user_id;
    }

    public function cancel(User $user, Booking $booking): bool
    {
        return $user->isAdmin() || ($user->id === $booking->user_id && $booking->booking_status !== 'Cancelled');
    }

    public function manage(User $user): bool
    {
        return $user->isAdmin();
    }
}
