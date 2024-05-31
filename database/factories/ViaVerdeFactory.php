<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ViaVerde>
 */
class ViaVerdeFactory extends Factory
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
            'company' => fake()->randomElement(['roboplan', 'robowork']),
            'identifier' => fake()->bothify('##-##-##-##'),
            'contract_type' => fake()->randomElement(['Permanente', 'Temporária']),
            'contract_number' => fake()->numerify('C#######'),
            'vehicle_class' => fake()->randomElement(['1', '2']),
            'active' => mt_rand(0, 1),
            'observation' => fake()->paragraph(),
        ];
    }
}
