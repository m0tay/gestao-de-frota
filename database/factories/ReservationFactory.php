<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends Factory<Reservation>
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
    $start_date = Carbon::createFromTimestamp($this->faker->dateTimeBetween('2024-03-01', '2024-03-31')->getTimestamp());
    $start_date->minute = $this->faker->randomElement([0, 10, 20, 30, 40, 50]);

    $end_date = clone $start_date;
    $end_date->minute = $this->faker->randomElement([0, 10, 20, 30, 40, 50]);
    $end_date->modify(fake()->randomElement(['+1 hour', '+2 hour', '+3 hour']));
    $vehicle = fake()->randomElement(Vehicle::where('group', 'public')->get());
    $driver = fake()->randomElement(User::all());
    $title = strtoupper($vehicle->plate) . " " . $driver->name;
    $status = Carbon::parse($start_date)->isPast() ? 'done' : fake()->randomElement(['accepted', 'denied', 'done']);


    return [
      'title' => $title,
      'start' => $start_date,
      'end' => $end_date,
      'rrule' => '',
      'status' => $status,
      'created_by' => fake()->randomElement(User::all()),
      'driver_id' => $driver,
      'vehicle_id' => $vehicle,
      'description' => fake()->sentence(6),
      'reason_for_status_change' => $status === 'denied' ? 'denied for any reason' : '',
    ];
  }
}
