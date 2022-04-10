<?php

declare(strict_types=1);

namespace Tests\Feature\Roles;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class EditRoleTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

    private $role;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->role = $this->new_role('ayudante', 'Ayudante');
    }

    /** @test */
    public function user_without_permissions_can_not_access_to_users_list()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        try {
            $this->actingAs($user);
            $response = $this->get(route('roles.edit', [$this->role]));
        } catch (\Throwable $th) {
            $this->assertEquals('User does not have any of the necessary access rights.', $th->getMessage());
        }
    }

    /** @test */
    public function user_can_access_to_see_list_roles()
    {
        $this->authenticated()
            ->get( route('roles.edit', [$this->role]) )
            ->assertOk();
    }
}