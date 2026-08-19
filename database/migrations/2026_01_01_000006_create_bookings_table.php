<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->foreignId('passenger_id')->constrained('passengers')->onDelete('cascade');
            $table->string('booking_reference')->unique();
            $table->integer('seats')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->string('booking_status')->default('Confirmed'); // Pending, Confirmed, Cancelled, Completed
            $table->string('payment_status')->default('Paid'); // Unpaid, Paid, Refunded
            $table->timestamp('booked_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
