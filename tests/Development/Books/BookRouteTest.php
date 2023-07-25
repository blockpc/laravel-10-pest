<?php

use App\Models\Profile;
use App\Models\User;
use Database\Seeders\RoleAndPermissionsSeeder;

it('can not see route books', function () {
    $this->get('sistema/libros')
        ->assertStatus(302);
});

it('can see route books for user authenticated', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    // Sign in
    $user = User::factory()->create();
    Profile::factory()->forUser($user)->create();

    // get route Acting as
    $this->actingAs($user)
        ->get('sistema/libros')
        ->assertStatus(200);
});
