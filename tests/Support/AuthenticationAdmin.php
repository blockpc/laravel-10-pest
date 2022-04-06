<?php

namespace Tests\Support;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

trait AuthenticationAdmin
{
    /** @var User $admin **/
    protected $admin;

    protected $role_admin;

    /**
     * @before
     */
    public function setUpUser()
    {
        $this->afterApplicationCreated(function () {
            $this->role_admin = $this->new_role('admin', 'Administrador');

            $permissions = $this->new_permissions_for([
                'user list', 'user create'
            ]);

            $this->role_admin->givePermissionTo([
                $permissions, 
            ]);

            $this->admin = User::factory()->create();
            $this->admin->assignRole($this->role_admin);
            Profile::factory()->forUser($this->admin)->create();
        });
    }

    public function authenticated(Authenticatable $user = null)
    {
        return $this->actingAs($user ?? $this->admin);
    }
}