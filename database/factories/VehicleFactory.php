<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'plate' => fake()->bothify('?? ## ?? ##'), // Simulate a license plate format
      'brand' => fake()->randomElement(['Ford', 'Toyota', 'Honda', 'BMW', 'Volkswagen']),
      'model' => fake()->word() . ' ' . fake()->randomNumber(3), // Basic model name
      'group' => fake()->randomElement(['private', 'public']),
      'category' => fake()->randomElement(['light', 'heavy']),
    ];
  }
}
