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
        Schema::create('breakdowns', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('driver_id')->constrained('users');
            $table->date('incident_date');
            $table->text('description');
            $table->string('incident_address_1');
            $table->string('incident_address_2')->nullable();
            $table->string('incident_address_city')->nullable();
            $table->string('incident_address_state')->nullable();
            $table->string('incident_address_code')->nullable();

            $table->string('workshop_address_1');
            $table->string('workshop_address_2')->nullable();
            $table->string('workshop_address_city')->nullable();
            $table->string('workshop_address_state')->nullable();
            $table->string('workshop_address_code')->nullable();
            $table->string('workshop_phone_number')->nullable();
            $table->date('entered_workshop_date')->nullable();

            $table->text('damages');


            $table->enum('status', ['pending', 'in_progress', 'done'])->default('pending');
            $table->text('observation')->nullable();

            $table->unsignedDecimal('labor_cost', 10, 2)->nullable();
            $table->unsignedDecimal('material_cost', 10, 2)->nullable();
            $table->unsignedDecimal('discount', 10, 2)->nullable();
            $table->unsignedDecimal('iva_tax', 10, 2)->nullable();
            $table->unsignedDecimal('total_cost', 10, 2)->nullable();

            $table->date('done_at')->nullable();
            $table->text('done_observation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breakdowns');
    }
};
