<?php

it('can have pending friends', function() {

    $user = new_user();
    $friend = new_user();

    $user->addFriend($friend);

    expect($user->pendingFriendOfMine)->toHaveCount(1);
});

it('can have friends requests', function() {

    $user = new_user();
    $friend = new_user();

    $friend->addFriend($user);

    expect($user->pendingFriendOf)->toHaveCount(1);
});

it('does not create duplicate friend request', function() {

    $user = new_user();
    $friend = new_user();

    $user->addFriend($friend);
    $user->addFriend($friend);

    expect($user->pendingFriendOfMine)->toHaveCount(1);
    expect($user->pendingFriendOfMine)->not()->toBe(2);
});

it('can accept friends', function() {

    $user = new_user();
    $friend = new_user();

    $user->addFriend($friend);
    $friend->acceptFriend($user);

    expect($user->acceptedFriendOfMine)->toHaveCount(1);
    expect($user->acceptedFriendOfMine->pluck('id'))->toContain($friend->id);

});
