<?php

namespace Tests\Support;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

trait AuthenticationUser
{
    /** @var User $user **/
    protected $user;

    protected $role_user;

    /**
     * @before
     */
    public function setUpUser()
    {
        $this->afterApplicationCreated(function () {
            $this->role_user = $this->new_role('user', 'Usuario Normalito');

            $this->user = User::factory()->create();
            $this->user->assignRole($this->role_user);
            Profile::factory()->forUser($this->user)->create();
        });
    }

    public function authenticated(Authenticatable $user = null)
    {
        return $this->actingAs($user ?? $this->user);
    }
}