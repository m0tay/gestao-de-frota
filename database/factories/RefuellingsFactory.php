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
        $vehicle = fake()->randomElement(Vehicle::where('group', 'public')->get());

        $vehicle->update(['kms' => $vehicle->kms + fake()->numberBetween(5, 250)]);
        $mileage = $vehicle->kms;
        $fuelType = $vehicle->fuel_type;

        return [
            'vehicle_id' => fake()->randomElement(Vehicle::where('group', 'public')->get()),
            'driver_id' => fake()->randomElement(User::all()),
            'liters' => fake()->numberBetween(10, 100),
            'price' => fake()->numberBetween(10, 100),
            'mileage' => $mileage,
            'refuel_date' => fake()->dateTimeThisYear('now'),
            'description' => fake()->realText(255),
            'fuel_type' => $fuelType,
        ];
    }

}
