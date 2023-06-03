<?php

declare(strict_types=1);

namespace Tests\Feature\Roles;

use App\Http\Livewire\System\Roles\FormRole;
use App\Models\User;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class CretaeRoleTest extends TestBase
{
    use AuthenticationAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_without_permissions_can_not_access_to_create_role()
    {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = User::factory()->create();

        try {
            $this->actingAs($user);
            $response = $this->get(route('roles.create'));
        } catch (\Throwable $th) {
            $this->assertEquals('User does not have any of the necessary access rights.', $th->getMessage());
        }
    }

    /** @test */
    public function user_can_access_to_see_list_roles()
    {
        $this->authenticated()
            ->get( route('roles.create') )
            ->assertOk();
    }

    /** @test */
    public function admin_can_to_see_form_to_create_role()
    {
        Livewire::actingAs($this->admin)
            ->test(FormRole::class)
            ->assertPropertyWired('role.name')
            ->assertPropertyWired('role.display_name')
            ->assertPropertyWired('role.description')
            ->assertMethodWiredToForm('save');
    }

    /**
     * @test
     * @dataProvider validationRules
     */
    public function check_errors_create_role($field, $value, $rule)
    {
        $ayudante = $this->new_role('ayudante', 'Un ayudante');

        Livewire::actingAs($this->admin)
            ->test(FormRole::class)
            ->set($field, $value)
            ->call('save')
            ->assertHasErrors([$field => $rule]);
    }

    public function validationRules()
    {
        return [
            'role name is required' => ['role.name', null, 'required'],
            'role name is too long' => ['role.name', str_repeat('*', 33), 'max'],
            'role name exists' => ['role.name', 'ayudante', 'unique'],
            'role display name is required' => ['role.display_name', null, 'required'],
            'role display name is too long' => ['role.name', str_repeat('*', 65), 'max'],
            'role description is too long' => ['role.description', str_repeat('*', 256), 'max']
        ];
    }
}
