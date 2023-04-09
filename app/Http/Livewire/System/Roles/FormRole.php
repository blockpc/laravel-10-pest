<?php

namespace App\Http\Livewire\System\Roles;

use Blockpc\App\Models\Permission;
use Blockpc\App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FormRole extends Component
{
    public Role $role;

    public $role_permissions;

    public $title_loading;

    public function mount(Role $role)
    {
        $this->role = $role;

        if ( $this->role->exists ) {
            $this->title_loading = __('roles.forms.messages.loading-edit');
            $this->role_permissions = $this->role->getAllPermissions()->pluck('name', 'id')->toArray();
        } else {
            $this->title_loading =  __('roles.forms.messages.loading-create');
            $this->role_permissions = [];
        }
    }

    public function render()
    {
        $permissions = $this->permissions();
        $list_permissions = [];
        foreach($permissions->groupBy('key') as $group => $collection) {
            $list_permissions[$group] = [];
            foreach($collection as $permission) {
                $list_permissions[$group][$permission->id] = $permission;
            }
        }
        return view('livewire.system.roles.form-role', [
            'permissions' => $list_permissions,
        ]);
    }

    protected function permissions()
    {
        if ( current_user()->hasRole('sudo') ) {
            return Permission::all();
        }
        return Permission::notAllowed()->get();
    }

    public function save()
    {
        $this->role_permissions = array_filter($this->role_permissions);
        $this->validate();

        $key = $this->role->exists ? 'roles.forms.messages.edit' : 'roles.forms.messages.create';

        $this->role->save();
        $this->role->syncPermissions($this->role_permissions);

        $message = __($key, ['role' => $this->role->display_name]);

        return redirect( route('roles.index') )->with('success', $message);
    }

    protected function rules()
    {
        $unique_name = !$this->role->exists
            ? Rule::unique('roles', 'name') : Rule::unique('roles', 'name')->ignore($this->role);
        return [
            'role.name' => ['required', 'alpha_num', 'max:32', $unique_name],
            'role.display_name' => ['required', 'string', 'max:64'],
            'role.description' => ['nullable', 'string', 'max:255'],
        ];
    }

    protected function validationAttributes()
    {
        return [
            'role.name' => __('roles.forms.attributes.role.name'),
            'role.display_name' => __('roles.forms.attributes.role.display_name'),
            'role.description' => __('roles.forms.attributes.role.description'),
        ];
    }
}
