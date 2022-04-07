<?php

declare(strict_types=1);

namespace Blockpc\App\Traits;

use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

trait AuthorizesRoleOrPermission
{
    public function authorizeRoleOrPermission($roleOrPermission, $guard = null)
    {
        if ( Auth::guard($guard)->guest() ) {
            throw UnauthorizedException::notLoggedIn();
        }

        $rolesOrPermissions = is_array($roleOrPermission)
            ? $roleOrPermission
            : explode('|', $roleOrPermission);

        if ( !$rolesOrPermissions ) {
            return false;
        }

        $auth = Auth::guard($guard)->user();

        if( $auth->hasRole('sudo') ) {
            return true;
        }

        $allPermissions = $auth->getAllPermissions();
        $allRoles = $auth->roles;
        
        if ( ! $auth->hasAnyPermission($allPermissions) ) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }

        if( ! $auth->hasAnyRole($rolesOrPermissions) && ! $auth->hasAnyPermission($rolesOrPermissions)) {
            throw UnauthorizedException::forRolesOrPermissions($rolesOrPermissions);
        }
    }
}