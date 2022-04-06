<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
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
}
