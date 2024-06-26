<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Reservation;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Refuellings;
use function Pest\Laravel\get;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    foreach (['admin', 'manager', 'user'] as $role) {
      Role::create([
        'name' => $role
      ]);
    }

    $roles = [
      'admin' => Role::where('name', 'admin')->first(),
      'manager' => Role::where('name', 'manager')->first(),
    ];

    $adminUser = User::factory()->create([
      'name' => 'Mykola',
      'email' => 'a@a.com',
      'company' => 'roboplan',
      'role_id' => $roles['admin']
    ]);

    $managerUser = User::factory()->create([
      'name' => 'José',
      'email' => 'm@m.com',
      'company' => 'roboplan',
      'role_id' => $roles['manager']
    ]);

    $userUser = User::factory()->create([
      'name' => 'User',
      'email' => 'u@u.com',
      'company' => 'robowork',
    ]);

    User::factory(20)->create();

    // Vehicle::factory(20)->create();

    // Reservation::factory(20)->create();

    // Refuellings::factory(20)->create();
  }
}
