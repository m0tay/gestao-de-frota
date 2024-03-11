<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use function Pest\Laravel\get;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
//        \App\Models\User::factory(10)->create();

//    $this->call([
//      RoleSeeder::class,
//    ]);
//
//    $roles = [
//      'admin' => Role::where('name', 'admin')->first(),
//      'manager' => Role::where('name', 'manager')->first(),
//    ];
//
//    $adminUser = User::factory()->create([
//      'name' => 'admin',
//      'email' => 'admin@admin.com',
//      'password' => bcrypt('password'),
//      'company' => 'roboplan',
//      'role_id' => $roles['admin']
//    ]);
//
//    $managerUser = User::factory()->create([
//      'name' => 'manager',
//      'email' => 'manager@manager.com',
//      'password' => bcrypt('password'),
//      'company' => 'roboplan',
//      'role_id' => $roles['manager']
//    ]);
//
//    $userUser = User::factory()->create([
//      'name' => 'user2',
//      'email' => 'user2@user.com',
//      'password' => bcrypt('password'),
//      'company' => 'robowork',
//    ]);

//      Vehicle::factory(5)->create();

    Reservation::factory(20)->create();
  }
}
