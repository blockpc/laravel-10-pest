<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\AuthenticationUser;
use Tests\TestBase;

final class ListUsersTest extends TestBase
{
    use RefreshDatabase, AuthenticationUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_without_permissions_can_not_access_to_users_list()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        try {
            $this->actingAs($user);
            $response = $this->get(route('users.index'));
        } catch (\Throwable $th) {
            $this->assertEquals('User does not have any of the necessary access rights.', $th->getMessage());
        }
    }

    /** @test */
    public function user_can_access_to_see_list_users()
    {
        $this->authenticated()
            ->get( route('users.index') )
            ->assertOk();
    }
}