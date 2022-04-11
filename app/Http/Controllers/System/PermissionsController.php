<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Blockpc\App\Traits\AuthorizesRoleOrPermission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    use AuthorizesRoleOrPermission;

    public function __invoke()
    {
        $this->authorizeRoleOrPermission('permission list');
        
        return view('permissions.index');
    }
}
