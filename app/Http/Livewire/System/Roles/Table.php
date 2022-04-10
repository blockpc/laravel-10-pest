<?php

namespace App\Http\Livewire\System\Roles;

use Blockpc\App\Models\Role;
use Blockpc\App\Traits\WithSorting;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;
    use WithSorting;

    public $search = "";
    public $paginate = 10;

    public function mount()
    {
        $this->sortField = 'name';
    }

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
}
