<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Http\Livewire\System\Users\FormUser;
use App\Models\Profile;
use App\Models\User;
use Blockpc\Events\ReSendLinkToChangePasswordEvent;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class EditUserTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

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
            $response = $this->get(route('users.edit', $user));
        } catch (\Throwable $th) {
            $this->assertEquals('User does not have any of the necessary access rights.', $th->getMessage());
        }
    }

    /** @test */
    public function can_resend_email_to_change_password()
    {
        Event::fake([ReSendLinkToChangePasswordEvent::class]);

        $knownDate = Carbon::create(2021, 4, 18, 12);
        Carbon::setTestNow($knownDate);

        $user = User::factory()->create([
            'email_verified_at' => Carbon::now()
        ]);
        Profile::factory()->forUser($user)->create();
        $user->assignRole('admin');

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email_verified_at' => Carbon::now(),
        ]);

        Livewire::actingAs($this->admin)
            ->test(FormUser::class, ['user' => $user])
            ->call('resend');

        Event::assertDispatched(ReSendLinkToChangePasswordEvent::class);
    }
}