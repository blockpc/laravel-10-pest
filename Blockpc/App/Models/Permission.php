<?php

declare(strict_types=1);

namespace Blockpc\App\Models;

use Spatie\Permission\Models\Permission as ModelsPermission;

final class Permission extends ModelsPermission
{
    protected $fillable = [
        'name',
        'guard_name',
        'display_name',
        'description',
        'key',
    ];
}