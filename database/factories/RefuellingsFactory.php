<?php

namespace Database\Factories;

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
        return [
            'vehicle_id' => Vehicle::factory(),
            'user_id' => User::factory(),
            'amount' => fake()->numberBetween(10, 100),
            'price' => fake()->numberBetween(10, 100),
            'mileage' => fake()->numberBetween(10000, 200000),
            'refuel_date' => fake()->dateTimeThisYear('now'),
            'description' => fake()->realText(255),
            'fuel_type' => fake()->randomElement(['gasoline', ' diesel', 'electric']),
        ];
    }

}
