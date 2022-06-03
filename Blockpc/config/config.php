<?php

return [
    'name' => 'Blockpc',
    'menus' => [
        'dashboard' => [
            'icon' => 'bx-layout',
            'name' => 'Dashboard',
            'route' => 'dashboard',
            'active' => 'dashboard',
        ],
        'todo' => [
            'icon' => 'heroicon-o-clipboard-list',
            'name' => 'Todo',
            'route' => 'todo',
            'active' => 'todo',
        ],
        'users' => [
            'icon' => 'heroicon-s-users',
            'name' => 'Users',
            'route' => 'users.index',
            'active' => 'users.*',
        ],
        'roles' => [
            'icon' => 'bx-shield',
            'name' => 'Roles',
            'route' => 'roles.index',
            'active' => 'roles.*',
        ],
        'permissions' => [
            'icon' => 'bx-label',
            'name' => 'Permissions',
            'route' => 'permissions.index',
            'active' => 'permissions.*',
        ],
    ]
];