<?php

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\Facades\Event;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can get a regiter form', function() {
    $this->get('/registro')
        ->assertStatus(200);
});

it('can show errors when regiter new user')
    ->post('/registro')
    ->assertSessionHasErrors([
        'name', 'email', 'password', 'firstname', 'lastname'
    ]);

it('can a regiter new user', function() {
    Event::fake();

    $this->post('/registro', [
        'name' => 'test',
        'email' => 'test@mail.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'firstname' => 'first',
        'lastname' => 'last'
    ])
        ->assertRedirect('/sistema/dashboard')
        ->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'name' => 'test',
        'email' => 'test@mail.com',
    ]);

    $this->assertDatabaseHas('profiles', [
        'firstname' => 'first',
        'lastname' => 'last'
    ]);

    Event::assertListening(Registered::class, SendEmailVerificationNotification::class);
});
