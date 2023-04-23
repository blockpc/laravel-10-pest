<?php

namespace App\Http\Livewire\System\Permissions;

use App\Models\User;
use Blockpc\App\Models\Permission;
use Blockpc\App\Models\Role;
use Livewire\Component;

class Table extends Component
{
    public User $user;

    protected $listeners = [
        'refresh' => '$refresh'
    ];

    public $role_permissions;
    public $role;

    public function mount()
    {
        $this->user = current_user();
        $this->role_permissions = $this->user->getAllPermissions()->pluck('name', 'id')->toArray();
        $this->role = $this->user->role_id;
    }

    public function getRolesProperty()
    {
        if ( $this->user->hasRole('sudo') ) {
            return Role::all()->pluck('display_name', 'id');
        }
        return Role::whereNotIn('name', ['sudo'])->pluck('display_name', 'id');
    }

    public function updatedRole($value)
    {
        $this->role_permissions = [];
        if ( $role = Role::find($value) ) {
            $this->role_permissions = $role->getAllPermissions()->pluck('name', 'id')->toArray();
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
        return view('livewire.system.permissions.table', [
            'permissions' => $list_permissions,
        ]);
    }

    protected function permissions()
    {
        if ( $this->user->is_sudo() ) {
            return Permission::all();
        }
        return Permission::notAllowed()->get();
    }
}
