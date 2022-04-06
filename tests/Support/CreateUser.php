<?php

declare(strict_types=1);

namespace Tests\Support;

use App\Models\Profile;
use App\Models\User;

trait CreateUser
{
    protected function new_user(array $attributes = [], $role = null)
    {
        $user = User::factory()->create($attributes);
        $user->assignRole($role ?? $this->role_user);
        Profile::factory()->forUser($user)->create();
        return $user;
    }
}