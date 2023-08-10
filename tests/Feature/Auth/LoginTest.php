<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('can show a login form')->get('/login')->assertStatus(200);

it('can show errors when login user')
    ->post('/login')
    ->assertSessionHasErrors([
        'email', 'password'
    ]);

it('user can login', function() {
    $user = new_user([
        'email' => 'test@mail.com',
        'password' => 'password'
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@mail.com'
    ]);

    expect($user)->toBeRedirectFor('/login', 'get');

    $this->assertAuthenticated();
});

it('user can login form', function() {
    $user = new_user([
        'email' => 'test@mail.com',
        'password' => 'password'
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'test@mail.com'
    ]);

    expect($user)->toBeRedirectFor('/login', 'post');

    $this->assertAuthenticated();
});
