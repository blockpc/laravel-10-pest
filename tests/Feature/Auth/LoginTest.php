<?php

use App\Models\Profile;
use App\Models\User;

it('can show a login form')->get('/login')->assertStatus(200);

it('can show errors when login user')
    ->post('/login')
    ->assertSessionHasErrors([
        'email', 'password'
    ]);

it('user can login', function() {
    // Sign in
    $user = User::factory()->create([
        'email' => 'test@mail.com',
        'password' => 'password'
    ]);
    Profile::factory()->forUser($user)->create();

    $this->assertDatabaseHas('users', [
        'email' => 'test@mail.com'
    ]);

    $this->actingAs($user)->get('/login')->assertStatus(302)->assertRedirect('/sistema/dashboard');

    $this->assertAuthenticated();
});

it('user can login form', function() {
    // Sign in
    $user = User::factory()->create([
        'email' => 'test@mail.com',
        'password' => 'password'
    ]);
    Profile::factory()->forUser($user)->create();

    $this->assertDatabaseHas('users', [
        'email' => 'test@mail.com'
    ]);

    $this->actingAs($user)->post('/login', [
        'email' => 'test@mail.com',
        'password' => 'password'
    ])
    ->assertStatus(302)
    ->assertRedirect('/sistema/dashboard');

    $this->assertAuthenticated();
});
