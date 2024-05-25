<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Reservation;
use App\Models\Vehicle;
use Carbon\Carbon;

beforeEach(function () {
    Role::create(['name' => 'user']);
});

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('assert that user can see reservations on agenda', function () {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get('/agenda')
        ->assertSee('Reservations');
});

test('assert that user can create a reservation', function () {
    $driver = User::factory()->create(['name' => 'José', 'email' => 'manager@manager.com']);
    $vehicle = Vehicle::factory()->create();
    $creator = $driver;

    $response = $this->actingAs($driver)
        ->post('/agenda', [
            'driver' => [
                'id' => $driver->id,
                'name' => $driver->name,
                'email' => $driver->email,
            ],
            'vehicle' => [
                'id' => $vehicle->id,
            ],
            'creator' => [
                'id' => $driver->id,
                'name' => $driver->name,
                'email' => $driver->email,
                'role' => [
                    'id' => 2,
                    'name' => 'manager',
                ],
                'company' => 'roboplan',
            ],
            'description' => 'simss',
            'start' => '2024-05-25T22:10:00.161Z',
            'end' => '2024-05-25T23:10:00.161Z',
        ]);

    $response->assertStatus(302);

    $response->assertRedirect('/');
    
});

