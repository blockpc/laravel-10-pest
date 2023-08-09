<?php

use Database\Seeders\RoleAndPermissionsSeeder;

it('can not see route books', function () {

    expectGuest()->toBeRedirectFor('sistema/books', 'get');

    // $this->get('sistema/books')->assertStatus(302);

});

it('can see route books for user authenticated', function() {

    $this->seed(RoleAndPermissionsSeeder::class);
    $user = new_user();

    $this->actingAs($user)->get('sistema/books/create')->assertStatus(200);
});
