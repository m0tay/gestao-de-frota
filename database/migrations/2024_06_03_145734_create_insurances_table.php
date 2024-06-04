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
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // General Information
            $table->string('insurance_company');

            $table->string('insurance_logo');

            // Customer Information
            $table->string('customer_name');

            // Mediator Information
            $table->string('mediator_name');

            // Annuity
            $table->dateTime('annuity_from');
            $table->dateTime('annuity_to');

            // Customer Address
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('address_city');
            $table->string('address_state');
            $table->string('address_code');
            $table->string('address_country');

            // Policy Number
            $table->string('policy_number');
            $table->decimal('annual_value', 10, 2);
            $table->decimal('own_damage_premium', 10, 2);
            $table->boolean('bonus')->default(false);
            $table->decimal('bonus_value', 10, 2);
            $table->text('observations')->nullable();
            $table->boolean('policy_canceled');
            $table->string('vehicle_id')->nullable();

            // Civil Liability  // Deductibles
            $table->string('civil_liability_bodily_injury');
            $table->string('civil_liability_property_damage');

            $table->string('bodily_injury_liability_deductible');
            $table->string('property_damage_liability_deductible');

            // Assistance   // Deductibles
            $table->string('legal_protection');
            $table->string('replacement_vehicle');
            $table->string('vip_travel_assistance');

            $table->string('legal_protection_deductible');
            $table->string('replacement_vehicle_deductible');
            $table->string('vip_travel_assistance_deductible');

            // Occupants and Driver Protection  // Deductibles
            $table->string('driver_treatment_expenses');
            $table->string('occupants_treatment_expenses');
            $table->string('death_or_permanent_disability');
            $table->string('pets_treatment_expenses');

            $table->string('driver_treatment_expenses_deductible');
            $table->string('occupants_treatment_expenses_deductible');
            $table->string('death_or_disability_deductible');
            $table->string('pets_treatment_expenses_deductible');

            // Own Damage   // Deductibles
            $table->string('glass_breakage');
            $table->string('theft_or_robbery');
            $table->string('fire_lightning_explosion');
            $table->string('natural_phenomena');
            $table->string('vandalism');
            $table->string('collision_rollover_glass_breakage');

            $table->string('glass_breakage_deductible');
            $table->string('theft_or_robbery_deductible');
            $table->string('fire_lightning_explosion_deductible');
            $table->string('natural_phenomena_deductible');
            $table->string('vandalism_deductible');
            $table->string('collision_rollover_glass_breakage_deductible');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};
