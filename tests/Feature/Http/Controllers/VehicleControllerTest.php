<?php

use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;

beforeEach(function () {
    Role::create(['name' => 'user']);
    Role::create(['name' => 'manager']);
    Role::create(['name' => 'admin']);
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

// test('only managers and admins can create a vehicle', function () {
//     $admin = User::factory()->create(
//         [
//             'role_id' => Role::get('admin')->id
//         ]
//     );
//     $manager = User::factory()->create(
//         [
//             'role_id' => Role::get('manager')->id
//         ]
//     );
//     $user = User::factory()->create(
//         [
//             'role_id' => Role::get('user')->id
//         ]
//     );

//     $this->actingAs($manager)
//         ->post('/vehicles', Vehicle::factory()->make()->toArray())
//         ->assertRedirect('/vehicles');

//     $this->actingAs($admin)
//         ->post('/vehicles', Vehicle::factory()->make()->toArray())
//         ->assertRedirect('/vehicles');

//     $this->actingAs($user)
//         ->post('/vehicles', Vehicle::factory()->make()->toArray())
//         ->assertSessionHasErrors()
//         ->assertRedirect('/vehicles');
// });


test('assert that there is vehicles on the index page', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get('/vehicles')
        ->assertSee('Vehicles');
});