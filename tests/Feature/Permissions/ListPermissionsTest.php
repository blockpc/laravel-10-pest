<?php

declare(strict_types=1);

namespace Tests\Feature\Permissions;

use App\Models\User;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class ListPermissionsTest extends TestBase
{
    use AuthenticationAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_without_permissions_can_not_access_to_permissions_list()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        $this->assertFalse($user->hasPermissionTo('permission list'));

        try {
            $this->actingAs($user);
            $response = $this->get(route('permissions.index'));
        } catch (\Throwable $th) {
            $this->assertEquals('User does not have any of the necessary access rights.', $th->getMessage());
        }
    }

    /** @test */
    public function user_can_access_to_see_list_permissions()
    {
        $this->authenticated()
            ->get( route('permissions.index') )
            ->assertOk();
    }
}
