<?php

use App\Models\User;
use App\Models\Role;
use App\Models\Reservation;

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