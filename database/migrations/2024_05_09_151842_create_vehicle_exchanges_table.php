<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_exchanges', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('driver_id')->constrained('users');
            $table->timestamp('start');
            $table->timestamp('end')->nullable();
            $table->text('observation')->nullable();
            $table->boolean('has_breakdown')->default(false);
            $table->text('breakdown_description')->nullable();
            $table->boolean('is_valid')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_exchanges');
    }
};
