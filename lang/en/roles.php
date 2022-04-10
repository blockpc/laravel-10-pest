<?php

return [
    'modals' => [
        'restore' => 'Are you sure you want to restore the associated role?',
        'restore-message' => 'This role will receive a link for set new password.',
        'delete' => 'Are you sure you want to delete the associated role?',
    ],
    'titles' => [
        'link' => 'Roles',
        'profile' => 'Role Profile',
        'list' => 'Roles List',
        'add' => 'Add Role',
        'create' => 'Create Role',
        'update' => 'Update Role',
        'delete' => 'Delete Role',
        'restore' => 'Restore Role',
    ],
    'table' => [
        'name' => 'Alias',
        'guard_name' => 'Guard',
        'display_name' => 'Role',
        'users_count' => 'User Count',
        'actions' => 'Actions',
    ], 
    'forms' => [
        'attributes' => [
            'title' => 'Role Data',
            'legend' => 'Info related at role',
            'role' => [
                'name' => 'Alias',
                'guard_name' => 'Guard',
                'select-guard' => 'Select Guard',
                'display_name' => 'Display Name',
                'description' => 'Description',
            ]
        ],
        'permissions' => [
            'title' => 'Permission List',
            'legend' => 'Permissions related at role',
        ],
        'create' => [
            'create-role' => 'Create Role',
            'edit-role' => 'Edit Role',
            'send-message' => 'if the role forgot their password, you could be send a email with a link to page for change the password. This link is valid for one change.',
        ],
        'messages' => [
            'loading-create' => 'Creating role...', 
            'loading-edit' => 'Editing role...', 
            'create' => 'The role :role was created succesfully', 
            'edit' => 'The role :role was edited succesfully', 
        ]
    ]
];