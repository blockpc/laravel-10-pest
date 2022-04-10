<?php

declare(strict_types=1);

namespace Tests\Feature\Roles;

use App\Http\Livewire\System\Roles\Table;
use App\Models\User;
use Blockpc\App\Models\Role;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class DeleteAndRestoreRoleTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

    private Role $role_user;
    private Role $role_helper;
    private Role $role_boss;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->role_user = $this->new_role('user', 'User');
        $this->role_helper = $this->new_role('helper', 'Helper');
        $this->role_boss = $this->new_role('boss', 'Boss');

        $users = User::factory(3)->create();
        $users->each(function($user) {
            $user->assignRole('helper');
        });
    }

    /** @test */
    public function verified_users_on_db()
    {
        $this->assertDatabaseHas('roles', [
            'name' => 'helper'
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => $this->role_helper->id,
            'model_id' => 2
        ]);
    }

    /** @test */
    public function admin_cannot_delete_a_role_base()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('delete', $this->role_admin->id)
            ->assertHasErrors(['error_role']);
    }

    /** @test */
    public function admin_cannot_delete_a_role_with_users()
    {
        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('delete', $this->role_helper->id)
            ->assertHasErrors(['error_role']);
    }

    /** @test */
    public function admin_can_delete_a_role_without_users()
    {
        $this->assertDatabaseHas('roles', [
            'name' => 'boss',
            'deleted_at' => null
        ]);

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('delete', $this->role_boss->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('roles', [
            'name' => 'boss',
            'deleted_at' => null
        ]);
    }

    /** @test */
    public function admin_can_force_delete_a_role_with_users()
    {
        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => $this->role_helper->id,
            'model_id' => 2
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'helper',
            'deleted_at' => null
        ]);

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('force_delete', $this->role_helper->id)
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('roles', [
            'name' => 'helper',
            'deleted_at' => null
        ]);

        $this->assertDatabaseHas('model_has_roles', [
            'role_id' => $this->role_user->id,
            'model_id' => 2
        ]);
    }

    /** @test */
    public function cannot_restore_a_fake_role()
    {
        $role_id = count(Role::all()) + 1;

        Livewire::actingAs($this->admin)
            ->test(Table::class)
            ->call('restore', $role_id)
            ->assertHasErrors(['error_role']);
    }

    /** @test */
    public function can_restore_a_role()
    {
        $knownDate = Carbon::create(2001, 5, 21, 12); // create testing date
        Carbon::setTestNow($knownDate); // set the mock
        
        $livewire = Livewire::actingAs($this->admin)->test(Table::class);

        $this->assertDatabaseHas('roles', [
            'name' => 'boss',
            'deleted_at' => null
        ]);

        $livewire->call('delete', $this->role_boss->id)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('roles', [
            'name' => 'boss',
            'deleted_at' => $knownDate
        ]);

        $livewire->call('restore', $this->role_boss->id)
            ->assertHasNoErrors();

        $this->assertDatabaseHas('roles', [
            'name' => 'boss',
            'deleted_at' => null
        ]);
    }
}