<?php

declare(strict_types=1);

namespace Tests\Feature\Users;

use App\Http\Livewire\System\Users\FormUser;
use App\Models\User;
use Blockpc\Events\SendEmailForNewUserEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class CreateUsersTest extends TestBase
{
    use RefreshDatabase;
    use AuthenticationAdmin;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $this->user = User::factory()->create([
            'name' => 'usuario',
            'email' => 'usuario@mail.com'
        ]);
    }

    /** @test */
    public function user_without_permissions_can_not_access_to_create_user()
    {
        try {
            $this->actingAs($this->user);
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

    /** 
     * @test 
     * @dataProvider validationRules
     */
    public function check_errors_create_user($field, $value, $rule)
    {
        Livewire::actingAs($this->admin)
            ->test(FormUser::class)
            ->set($field, $value)
            ->call('save')
            ->assertHasErrors([$field => $rule]);
    }

    public function validationRules()
    {
        return [
            'user name is null' => ['user.name', null, 'required'],
            'user name only alpha and numbers' => ['user.name', 'alpha num', 'alpha_num'],
            'user name is too long' => ['user.name', str_repeat('*', 65), 'max'],
            'user name is not unique' => ['user.name', 'usuario', 'unique'],
            'user email is null' => ['user.email', null, 'required'],
            'user email is invalid' => ['user.email', 'this is not an email', 'email'],
            'user email is not unique' => ['user.email', 'usuario@mail.com', 'unique'],
            'user email is too long' => ['user.email', str_repeat('*', 65), 'max'],
            'user profile firstname is too long' => ['profile.firstname', str_repeat('*', 65), 'max'],
            'user profile lastname is too long' => ['profile.lastname', str_repeat('*', 65), 'max'],
            'user profile phone not valid' => ['profile.phone', '+56 9 696 #969', 'regex'],
            'user profile phone is too long' => ['profile.phone', '+56 9 696969231213', 'max'],
            'role is empty' => ['role', '', 'required'],
            'role is not valid' => ['role', 'as', 'integer'],
            'role not exusts' => ['role', 100, 'exists'],
        ];
    }

    /** @test */
    public function admin_can_create_a_new_user()
    {
        $this->assertDatabaseHas('roles', [
            'id' => $this->role_admin->id,
            'name' => 'admin'
        ]);

        $livewire = Livewire::actingAs($this->admin)
            ->test(FormUser::class)
            ->set('user.name', 'jhon')
            ->set('user.email', 'jhon@mail.com')
            ->set('role',  $this->role_admin->id)
            ->set('profile.firstname', 'Jhon')
            ->set('profile.lastname', 'Doe')
            ->set('profile.phone', '+56 961881674')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('users', [
            'name' => 'jhon',
            'email' => 'jhon@mail.com',
        ]);
    }

    /** @test */
    public function emit_event_after_create_user()
    {
        Event::fake([SendEmailForNewUserEvent::class]);

        Livewire::actingAs($this->admin)
            ->test(FormUser::class)
            ->set('user.name', 'jhon')
            ->set('user.email', 'jhon@mail.com')
            ->set('role',  $this->role_admin->id)
            ->set('profile.firstname', 'Jhon')
            ->set('profile.lastname', 'Doe')
            ->set('profile.phone', '+56 961881674')
            ->call('save')
            ->assertHasNoErrors();

        Event::assertDispatched(SendEmailForNewUserEvent::class);
    }
}