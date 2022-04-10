<?php

return [
    'modals' => [
        'restore' => 'Are you sure you want to restore the associated user?',
        'restore-message' => 'This user will receive a link for set new password.',
        'delete' => 'Are you sure you want to delete the associated user?',
    ],
    'titles' => [
        'link' => 'Users',
        'profile' => 'User Profile',
        'list' => 'Users List',
        'add' => 'Add User',
        'create' => 'Create User',
        'update' => 'Update User',
        'delete' => 'Delete User',
        'restore' => 'Restore User',
    ],
    'table' => [
        'user' => 'User',
        'email' => 'Email',
        'status' => 'Status',
        'role' => 'Role',
        'actions' => 'Actions',
    ], 
    'forms' => [
        'attributes' => [
            'title' => 'User Data',
            'legend' => 'Info related at user',
            'user' => [
                'name' => 'User Name',
                'email' => 'User Email',
            ],
            'role' => 'role',
            'profile' => [
                'firstname' => 'Firstname',
                'lastname' => 'Lastname',
                'phone' => 'Phone',
                'image' => 'Image',
            ]
        ],
        'create' => [
            'create-user' => 'Create User',
            'edit-user' => 'Edit User',
            'select-role' => 'Create User',
            'send-pass' => 'Resend Password',
            'send-link' => 'Resend Link',
            'send-message' => 'if the user forgot their password, you could be send a email with a link to page for change the password. This link is valid for one change.',
        ],
        'messages' => [
            'delete' => 'The user :user was deleted', 
            'restore' => 'The user :user was restored', 
        ]
    ]
];