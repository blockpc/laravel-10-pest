<?php

use App\Models\User;
use Database\Seeders\RoleAndPermissionsSeeder;

uses(Illuminate\Foundation\Testing\RefreshDatabase::class);

it('show list for the user pending friends', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $friends = User::factory(2)->create();

    $friends->each(fn ($friend) => $user->addFriend($friend));

    expect($user->pendingFriendOfMine)->toHaveCount(2);

    actingAs($user)->get( route('friend.index') )
        ->assertSeeTextInOrder(array_merge(['Pending friends requests'], $friends->pluck('name')->toArray()));
});

it('show list for the user friends', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $friends = User::factory(3)->create();

    $friends->each(fn ($friend) => $friend->addFriend($user));

    actingAs($user)->get( route('friend.index') )
        ->assertSeeTextInOrder(array_merge(['Friends requests'], $friends->pluck('name')->toArray()));
});

it('show list for the user accepted friends', function() {
    $this->seed(RoleAndPermissionsSeeder::class);

    $user = new_user();

    $friends = User::factory(3)->create();

    $friends->each(fn ($friend) => $user->addFriend($friend));

    $friends->first()->acceptFriend($user);

    actingAs($user)->get( route('friend.index') )
        ->assertSeeTextInOrder(array_merge(['Accepted Friends'], $user->acceptedFriendOfMine->pluck('name')->toArray()));
});
