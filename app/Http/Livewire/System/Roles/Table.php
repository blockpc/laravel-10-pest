<?php

namespace App\Http\Livewire\System\Roles;

use Blockpc\App\Models\Role;
use Blockpc\App\Traits\WithSoftDeletes;
use Blockpc\App\Traits\WithSorting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use WithSorting;
    use WithSoftDeletes;

    public $search = "";
    public $paginate = 10;

    public $roles_base = Role::ROLES_NOT_DELETES;

    public function getRolesProperty()
    {
        $roles = Role::withCount(['users'])->where('guard_name', 'web');

        if ( !current_user()->hasRole('sudo') ) {
            $roles->whereNotIn('name', ['sudo']);
        }

        $roles->when($this->search, function($query) {
            $query->whereLike(['name', 'display_name', 'description'], $this->search);
        });

        return $roles->latest()->paginate($this->paginate);
    }
    
    public function render()
    {
        return view('livewire.system.roles.table');
    }

    public function delete(Role $role)
    {
        if ( in_array($role->name, $this->roles_base) ) {
            $this->addError('error_role', __('roles.forms.messages.error-role-base'));
            return;
        }
        if ( $count = $role->hasUsers() ) {
            $this->addError('error_role', __('roles.forms.messages.error-role-users', [
                'role' => $role->display_name,
                'count' => $count,
            ]));
            return;
        }
        $this->alert(__('roles.forms.messages.error-role-delete', ['role' => $role->display_name]), __('roles.titles.delete'));
        $role->delete();
    }

    public function restore(int $id)
    {
        $this->addError('error_role', __('roles.forms.messages.success-role-restore'));
        return;
    }
}
