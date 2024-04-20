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

    $this->call([
      RoleSeeder::class,
    ]);

    $roles = [
      'admin' => Role::where('name', 'admin')->first(),
      'manager' => Role::where('name', 'manager')->first(),
    ];

    $adminUser = User::factory()->create([
      'name' => 'Mykola',
      'email' => 'admin@admin.com',
      'password' => bcrypt('password'),
      'company' => 'roboplan',
      'role_id' => $roles['admin']
    ]);

    $managerUser = User::factory()->create([
      'name' => 'José',
      'email' => 'manager@manager.com',
      'password' => bcrypt('password'),
      'company' => 'roboplan',
      'role_id' => $roles['manager']
    ]);

    $userUser = User::factory()->create([
      'name' => 'User',
      'email' => 'user@user.com',
      'company' => 'robowork',
    ]);

    User::factory(5)->create();

    Vehicle::factory(20)->create();

    Reservation::factory(150)->create();

    Refuellings::factory(150)->create();
  }
}
