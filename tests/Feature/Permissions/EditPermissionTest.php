<?php

declare(strict_types=1);

namespace Tests\Feature\Permissions;

use App\Http\Livewire\System\Permissions\Edit;
use Blockpc\App\Models\Permission;
use Livewire\Livewire;
use Tests\Support\AuthenticationAdmin;
use Tests\TestBase;

final class EditPermissionTest extends TestBase
{
    use AuthenticationAdmin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function user_can_see_user_list_permission()
    {
        $this->assertDatabaseHas('permissions', [
            'name' => 'user list',
            'display_name' => 'user list',
        ]);

        $this->authenticated()
            ->get( route('permissions.index') )
            ->assertOk()
            ->assertSeeText('user list');
    }

    /**
     * @test
     * @dataProvider validationRules
     */
    public function check_errors_edit_permissions($field, $value, $rule)
    {
        $this->assertDatabaseHas('permissions', [
            'name' => 'user list',
            'display_name' => 'user list',
        ]);

        $permission = Permission::whereName('user list')->first();

        Livewire::actingAs($this->admin)
            ->test(Edit::class, ['permission_id' => $permission->id])
            ->set($field, $value)
            ->call('save')
            ->assertHasErrors([$field => $rule]);
    }

    /** @test */
    public function user_can_edit_a_permission()
    {
        $this->assertDatabaseHas('permissions', [
            'name' => 'user list',
            'display_name' => 'user list',
        ]);

        $permission = Permission::whereName('user list')->first();

        $this->assertTrue($permission->exists);

        Livewire::actingAs($this->admin)
            ->test(Edit::class, ['permission_id' => $permission->id])
            ->assertSet('permission.id', $permission->id)
            ->set('permission.display_name', 'edit user list')
            ->set('permission.description', 'edit description user list')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseMissing('permissions', [
            'name' => 'user list',
            'display_name' => 'user list',
        ]);

        $this->assertDatabaseHas('permissions', [
            'display_name' => 'edit user list',
            'description' => 'edit description user list',
        ]);
    }

    public function validationRules()
    {
        return [
            'permission display name is required' => ['permission.display_name', null, 'required'],
            'permission display name is too long' => ['permission.display_name', str_repeat('*', 65), 'max'],
            'permission description is too long' => ['permission.description', str_repeat('*', 256), 'max']
        ];
    }
}
