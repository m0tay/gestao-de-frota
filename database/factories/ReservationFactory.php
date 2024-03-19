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
        $start_date = Carbon::createFromTimestamp($this->faker->dateTimeBetween('2024-02-01', '2024-04-31')->getTimestamp());
        $start_date->minute = fake()->randomElement([0, 30]);
        $end_date = clone $start_date;
        $end_date->minute = fake()->randomElement([0, 30]);
        $end_date->modify(fake()->randomElement(['+1 hour', '+2 hour', '+3 hour', '+4 hour', '+1 day']));
        $vehicle = fake()->randomElement(Vehicle::where('group', 'public')->get());
        $startKms = $vehicle->kms;
        $driver = fake()->randomElement(User::all());
        $title = strtoupper($vehicle->plate) . " - " . $driver->name;
        $status = Carbon::parse($start_date)->isPast() ? 'done' : fake()->randomElement(['accepted', 'denied']);
        $status2 = fake()->randomElement(['accepted', 'denied', 'rescheduled']);
        $condition = fake()->randomElement(['ok', 'nok']);
        $vehicle->update(['kms' => $vehicle->kms + fake()->numberBetween(5, 250)]);
        $returnKms = $vehicle->kms;

        $return = null;

        if (mt_rand(0, 1)) {
            $return = fake()->dateTimeBetween($start_date, $end_date);
        } else {
            $end = clone $end_date;
            $return = fake()->dateTimeBetween($start_date, $end->modify(fake()->randomElement(['+1 hour', '+2 hour', '+5 minute', '+15 minute', '+30 minute'])));
        }

        $creator = null;

        if (mt_rand(0, 1)) {
            $creator = User::whereHas('role', function ($query) {
                $query->where('name', 'admin')->orWhere('name', 'manager');
            })->get()->random();
        } else {
            $creator = clone $driver;
        }


        return [
            'title' => $title,
            'start' => $start_date,
            'start_kms' => $startKms,
            'end' => $end_date,
            'return' => $return,
            'return_kms' => $returnKms,
            'return_condition' => $condition,
            'return_condition_description' => $condition === "ok" ? '' : fake()->randomElement(['parti o retrovisor', 'risquei a lataria', 'bati a traseira', 'símbolo estranho acendeu-se no odómetro']),
            'status' => $status2,
            'created_by' => $creator,
            'driver_id' => $driver,
            'vehicle_id' => $vehicle,
            'description' => fake()->sentence(6),
            'reason_for_status_change' => $status === 'denied' ? fake()->randomElement(['foi preciso', 'contacte-nos', 'sem cabimento', 'cancelado']) : '',
        ];
    }
}
