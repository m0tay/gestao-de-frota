<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TireSet>
 */
class TireSetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => fake()->randomElement(Vehicle::pluck('id')->toArray()),
            'tire_booklet' => fake()->randomElement(config('vehicles.tires.booklet')),
            'tire1_brand' => fake()->randomElement(config('vehicles.tires.brands')),
            'tire1_axle' => fake()->randomElement(config('vehicles.tires.axles')),
            'tire2_brand' => fake()->randomElement(config('vehicles.tires.brands')),
            'tire2_axle' => fake()->randomElement(config('vehicles.tires.axles')),
        ];
    }
}
