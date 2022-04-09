<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\User;
use Blockpc\App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    use AuthorizesRoleOrPermission;
    
    public function index()
    {
        $this->authorizeRoleOrPermission('user list');

        return view('users.index');
    }

    public function create()
    {
        $this->authorizeRoleOrPermission('user create');

        return view('users.create');
    }

    public function edit(User $user)
    {
        $this->authorizeRoleOrPermission('user update');

        return view('users.edit', compact('user'));
    }
}
