<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $start_date = fake()->dateTimeBetween('2024-03-01', '2024-03-31');
    $end_date = $start_date;
    $end_date->modify('+1 hour');

    return [
      'title' => fake()->word(),
      'start' => $start_date,
      'end' => $end_date,
      'rrule' => fake()->randomElement([null, 'RRULE:FREQ=WEEKLY;BYDAY=MO,WE,FR']), // Optional repeat rule
      'status' => fake()->randomElement(['accepted', 'denied', 'done']),
      'created_by' => fake()->randomElement(User::all()), // Generate a user and use the ID
      'driver_id' => fake()->randomElement(User::all()), // Generate another user for the driver
      'vehicle_id' => fake()->randomElement(Vehicle::all()), // Generate a vehicle
      'description' => fake()->sentence(6), // Short description
//      'previous_reservation' => fake()->boolean(20) ? Reservation::factory()->create()->id : null, // 20% chance of having a previous reservation
    ];
  }
}
