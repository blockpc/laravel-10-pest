<?php

declare(strict_types=1);

namespace Tests\Development;

use App\Models\User;
use Blockpc\App\Models\Role;
use Blockpc\Notifications\NewUserNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\Support\AuthenticationAdmin;
use Tests\Support\DevMode;
use Tests\TestBase;

final class RouteDevelopmentTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;
    use DevMode;

    private User $user;
    private Role $role;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        if ( $this->dev_mode() ) {
            $this->markTestSkipped('This test run only in local development --see DevMode trait--.');
        }

        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->user = User::factory()->create([
            'name' => 'user',
            'email' => 'user@mail.com'
        ]);

        $this->role = $this->new_role('user', 'user');
    }

    /** @test */
    public function can_access_to_dev_route()
    {
        $this->authenticated()
            ->get( route('dev.index') )
            ->assertOk();

        $this->assertTrue(config('app.env') == 'testing');
    }

    /** @test */
    public function can_send_notification_to_user()
    {
        // $this->authenticated()
        //     ->get( route('dev.notification') )
        //     ->assertOk();

        // $this->assertDatabaseHas('users', [
        //     'name' => 'user',
        //     'email' => 'user@mail.com'
        // ]);

        // $this->assertDatabaseCount('notifications', 1);

        $admins = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->get();

        $message = "new user created: {$this->user->email}";

        Notification::fake();

        Notification::send($admins, new NewUserNotification($message));

        Notification::assertSentTo(
            [$admins], NewUserNotification::class, function ($notification, $channels) use($message){
                $this->assertContains('database', $channels);
    
                $databaseNotification = (object)$notification->toArray($message);
                $this->assertEquals( "new user created: {$this->user->email}", $databaseNotification->message);
    
                return true;
            }
        );
    }
}