<?php

use Database\Seeders\RoleAndPermissionsSeeder;

it('can not see route books', function () {
    $this->get('sistema/libros')
        ->assertStatus(302);
});

it('only allows authendticated users to get', function () {
    $this->get('sistema/libros/nuevo')
        ->assertStatus(302);
});

it('only allows authendticated users to post', function () {
    $this->post('sistema/libros/nuevo')
        ->assertStatus(302);
});

it('can see route books for user authenticated', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $this->actingAs($user)
        ->get('sistema/libros/nuevo')
        ->assertStatus(200);
});
