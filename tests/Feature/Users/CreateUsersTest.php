<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Http\Livewire\System\Users\FormUser;
use App\Models\User;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class CreateUsersTest extends TestBase
{
    use AuthenticationAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_without_permissions_can_not_access_to_create_user()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        try {
            $this->actingAs($user);
            $response = $this->get(route('users.create'));
        } catch (\Throwable $th) {
            $this->assertEquals('User does not have any of the necessary access rights.', $th->getMessage());
        }
    }

    /** @test */
    public function admin_can_access_to_create_users()
    {
        $this->authenticated()
            ->get( route('users.create') )
            ->assertOk();
    }

    /** @test */
    public function admin_can_to_see_form_to_create_users_central()
    {
        Livewire::actingAs($this->admin)
            ->test(FormUser::class)
            ->assertPropertyWired('user.name')
            ->assertPropertyWired('user.email')
            ->assertPropertyWired('role')
            ->assertPropertyWired('profile.firstname')
            ->assertPropertyWired('profile.lastname')
            ->assertPropertyWired('profile.phone')
            ->assertMethodWiredToForm('save');
    }
}