<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FleetCard>
 */
class FleetCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company' => fake()->company(),
            'code' => fake()->unique()->bothify('??###'),
            'pin' => fake()->unique()->bothify('???##?#'),
            'type' => fake()->randomElement(['Combustível', 'Elétrico']),
            'expire_at' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'vehicle_id' => fake()->randomElement(Vehicle::pluck('id')->toArray()),
        ];
    }
}
