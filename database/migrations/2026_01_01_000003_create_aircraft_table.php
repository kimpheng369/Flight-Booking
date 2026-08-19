<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aircraft', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');
            $table->string('model');
            $table->string('registration_number')->unique();
            $table->integer('seat_capacity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aircraft');
    }
};
