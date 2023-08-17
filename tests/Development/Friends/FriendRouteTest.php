<?php

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('guest can not see route friends', function () {

    expectGuest()->toBeRedirectFor( route('friend.index') , 'get', 'login');

});

it('user authenticated can see route friends', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $this->actingAs($user)->get(route('friend.index'))->assertStatus(200);
});

it('guest can not get a friends', function () {

    expectGuest()->toBeRedirectFor(route('friend.add'), 'get', 'login');

});

it('user authenticated can get add a friends', function () {

    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $this->actingAs($user)->get(route('friend.add'))->assertStatus(200);

});

it('guest can not add a friends', function () {

    expectGuest()->toBeRedirectFor(route('friend.store'), 'post', 'login');

});

it('user authenticated can add a friends', function () {

    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();
    $friend = new_user();

    $this->actingAs($user)->post(route('friend.store'), [
            'email' => $friend->email
        ])
        ->assertStatus(302)
        ->assertRedirect(route('friend.index'));

    $this->assertDatabaseHas('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id,
        'accepted' => false,
    ]);

});

it('guest can not accept a friend', function () {

    expectGuest()->toBeRedirectFor( route('friend.accept', 1) , 'put', 'login');

});

it('user authenticated can accept a friend', function () {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();
    $friend = new_user();

    $friend->addFriend($user);

    $this->actingAs($user)->put( route('friend.accept', $friend->id) )
        ->assertStatus(302)
        ->assertRedirect(route('friend.index'));

    $this->assertDatabaseHas('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id,
        'accepted' => true,
    ]);

});

it('guest can not cancel a request', function () {

    expectGuest()->toBeRedirectFor('sistema/friends/cancel-a-friend/1', 'delete', 'login');

});

it('user authenticated can cancel a request', function () {

    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();
    $friend = new_user();

    $user->addFriend($friend);

    $this->actingAs($user)->delete( route('friend.cancel', $friend->id) )
        ->assertStatus(302)
        ->assertRedirect(route('friend.index'));

    $this->assertDatabaseMissing('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id
    ]);

})->skip();

it('guest can not remove a friend', function () {

    expectGuest()->toBeRedirectFor('sistema/friends/remove-a-friend/1', 'delete', 'login');

});

it('user authenticated can remove a friend', function () {

    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();
    $friend = new_user();

    $user->addFriend($friend);

    $this->actingAs($user)->delete( route('friend.remove', $friend->id) )
        ->assertStatus(302)
        ->assertRedirect(route('friend.index'));

    $this->assertDatabaseMissing('friends', [
        'user_id' => $user->id,
        'friend_id' => $friend->id
    ]);

});
