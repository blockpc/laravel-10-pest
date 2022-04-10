<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Blockpc\App\Models\Role;
use Blockpc\App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    use AuthorizesRoleOrPermission;

    public function index()
    {
        $this->authorizeRoleOrPermission('role list');
        
        return view('roles.index');
    }

    public function create()
    {
        $this->authorizeRoleOrPermission('role create');
        
        return view('roles.create');
    }

    public function edit(Role $role)
    {
        $this->authorizeRoleOrPermission('role update');
        
        return view('roles.edit', compact('role'));
    }
}
