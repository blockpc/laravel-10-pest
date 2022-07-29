<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\User;
use Blockpc\Services\Facades\Sender;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class CreateNotificationTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->user = User::factory()->create();
        $this->user->assignRole('admin');
    }

    /** @test */
    public function can_create_notification()
    {
        $this->authenticated()
            ->get( route('create-notification') )
            ->assertOk();

        $this->assertDatabaseHas('notifications', [
            'data' => "{\"message\":\"A new todo created. 1\",\"user\":\"{$this->admin->name}\"}"
        ]);
    }

    /** @test */
    public function sender_on_create_notification_works()
    {
        Sender::shouldReceive('new_todo')
            ->once()
            ->andReturn(true);

        $this->authenticated()
            ->get( route('create-notification') )
            ->assertOk();
    }
}