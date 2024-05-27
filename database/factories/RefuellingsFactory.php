<?php

namespace Database\Factories;

use App\Models\FuelType;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RefuellingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $vehicle = fake()->randomElement(Vehicle::where('status', config('vehicles.statuses')[1])->get());
        $mileage = $vehicle->kms;
        $fuelType = fake()->randomElement(config('vehicles.fuel_types.refuelling'));
        
        $vehicle->update(['kms' => $vehicle->kms + fake()->numberBetween(5, 250)]);


        return [
            'vehicle_id' => $vehicle->id,
            'driver_id' => fake()->randomElement(User::all()),
            'liters' => $fuelType !== 'Elétrico' ? fake()->numberBetween(10, 100) : 0,
            'price' => $fuelType !== 'Elétrico' ? fake()->randomFloat(2, 1.5, 2) : 0,
            'mileage' => $mileage,
            'refuel_date' => fake()->dateTimeThisYear('now'),
            'description' => fake()->realText(255),
            'fuel_type' => $fuelType,
        ];
    }
}
