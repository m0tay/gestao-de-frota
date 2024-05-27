<?php

namespace Database\Factories;

use App\Models\FuelType;
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
            'plate' => fake()->bothify('??-##-??'),
            'brand' => fake()->randomElement(config('vehicles.brands')),
            'model' => fake()->word() . ' ' . fake()->randomNumber(3),
            'color' => fake()->randomElement(config('vehicles.colors')),
            'chassis' => fake()->bothify('##-##-##-##-##-##-##-##-##-##'),
            'category' => fake()->randomElement(config('vehicles.categories')),
            'proprietary' => fake()->randomElement(config('vehicles.proprietaries')),
            'is_active' => true,
            'kms' => fake()->numberBetween(50_000, 200_000),
            'fuel_type' => fake()->randomElement(config('vehicles.fuel_types.assigning')),
            'status' => fake()->randomElement(config('vehicles.statuses')),
        ];
    }
}
