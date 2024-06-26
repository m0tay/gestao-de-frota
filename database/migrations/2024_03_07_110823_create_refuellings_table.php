<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('refuellings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('driver_id')->constrained('users');
            $table->unsignedDecimal('liters', 6, 2);
            $table->unsignedDecimal('price', 6, 2);
            $table->unsignedBigInteger('mileage');
            $table->date('refuel_date');
            $table->string('description')->nullable();
            $table->string('fuel_type');
            // $table->foreign('fuel_type')->references('fuel_type')->on('fuel_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refuellings');
    }
};
