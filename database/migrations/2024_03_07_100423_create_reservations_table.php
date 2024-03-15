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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamp('start');
            $table->timestamp('end');
            $table->enum('status', ['accepted', 'denied', 'done', 'rescheduled']);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('driver_id')->constrained('users');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->string('title');
            $table->text('description');
            $table->text('reason_for_status_change')->nullable();
            $table->foreignId('previous_reservation')->nullable()->constrained('reservations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
