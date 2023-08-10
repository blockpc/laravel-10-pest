<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('show the form to add user', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    actingAs($user)->get('sistema/friends/add-a-friend')
        ->assertSeeTextInOrder(['Add a Friend', 'Send Request']);
});


it('validate an email', function(string $email, string $message) {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user([
        'email' => 'test@mail.com'
    ]);

    $this->actingAs($user)->post('sistema/friends/add-a-friend', [
            'email' => $email
        ])
        ->assertSessionHasErrors(['email' => $message]);
})
->with(
    ['for required' => ['', 'El campo email es obligatorio.']],
    ['for email' => ['not-an-email', 'El campo email debe ser una dirección de correo válida.']],
    ['for exists' => ['mail@mail.com', 'El campo email seleccionado no existe.']],
    ['not self' => ['test@mail.com', 'El campo email seleccionado es inválido.']],
);

it('store the friend request', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();
    $friend = new_user();

    $this->actingAs($user)->post('sistema/friends/add-a-friend', [
        'email' => $friend->email
    ])
    ->assertSessionHasNoErrors();

    $this->assertDatabaseHas('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id,
        'accepted' => false
    ]);

    expect($user->pendingFriendOfMine)->toHaveCount(1);

});
