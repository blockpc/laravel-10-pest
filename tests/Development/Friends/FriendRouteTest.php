<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('guest can not see route friends', function () {

    expectGuest()->toBeRedirectFor('sistema/friends', 'get', 'login');

});

it('user authenticated can see route friends', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $this->actingAs($user)->get('sistema/friends')->assertStatus(200);
});

it('guest can not see route for add a friends', function () {

    expectGuest()->toBeRedirectFor('sistema/friends/add-a-friend', 'get', 'login');

});

it('user authenticated can see route for add a friends', function () {

    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $this->actingAs($user)->get('sistema/friends/add-a-friend')->assertStatus(200);

});
