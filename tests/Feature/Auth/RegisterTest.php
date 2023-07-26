<?php

it('can get a regiter form', function() {
    $this->get('/registro')
        ->assertStatus(200);
});

// it('can show errors when regiter new user', function() {
//     $this->post('/registro')
//         ->assertSessionHasErrors([
//             'name', 'email', 'password', 'firstname', 'lastname'
//         ]);
// });

it('can show errors when regiter new user')
    ->post('/registro')
    ->assertSessionHasErrors([
        'name', 'email', 'password', 'firstname', 'lastname'
    ]);

// it('can a regiter new user', function() {
//     $this->post('/registro', [
//         'name' => 'test',
//         'email' => 'test@mail.com',
//         'password' => 'password',
//         'password_confirmation' => 'password',
//         'firstname' => 'first',
//         'lastname' => 'last'
//     ])
//         ->assertRedirect('/sistema/dashboard')
//         ->assertStatus(302);

//     $this->assertDatabaseHas('users', [
//         'name' => 'test',
//         'email' => 'test@mail.com',
//     ]);

//     $this->assertDatabaseHas('profiles', [
//         'firstname' => 'first',
//         'lastname' => 'last'
//     ]);
// });

it('can a regiter new user')
    ->defer(function() {
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
    })
    ->assertDatabaseHas('users', [
        'name' => 'test',
        'email' => 'test@mail.com',
    ])
    ->assertDatabaseHas('profiles', [
        'firstname' => 'first',
        'lastname' => 'last'
    ])
    ->assertAuthenticated();
