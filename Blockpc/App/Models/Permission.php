<?php

declare(strict_types=1);

namespace Blockpc\App\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;

final class Permission extends ModelsPermission
{
    const DEFAULTS = [
        4 => "user list",
        9 => "role list",
        14 => "permission list"
    ];

    const NOT_ALLOWED = [
        'super admin',
        'settings control',
        'jobs control'
    ];

    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
        'key',
    ];

    public function scopeNotAllowed($query)
    {
        return $query->whereNotIn('name', self::NOT_ALLOWED);
    }
}
