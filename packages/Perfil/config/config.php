<?php

return [
    'name' => 'Perfil',
    'menus' => [
        'perfil' => [
            'icon' => '', // add icon key here. see https://blade-ui-kit.com/blade-icons
            'name' => __('perfil::perfil.name'), // if you use a translation file
            'route' => 'perfil.index',
            'active' => 'perfil.*',
            'permission' => '',
            'submenus' => [
                [
                    'href' => 'perfil.create', // dont forget create route before in web.php
                    'name' => 'sub menu perfil one',
                    'permission' => ''
                ],
            ]
        ]
    ]
];

// Example menu with submenus
// 
// 'menus' => [
//     'perfil' => [
//         'icon' => '', // add icon key here. see https://blade-ui-kit.com/blade-icons
//         'name' => __('perfil::perfil.menu'), // if you use a translation file
//         'route' => 'perfil.index',
//         'active' => 'perfil.*',
//         'permission' => '', // add permission key here
//         'submenus' => [
//             [
//                 'href' => 'perfil.route', // dont forget create route 'perfil.route' before in web.php
//                 'name' => 'sub menu perfil one',
//                 'permission' => '' // add permission key here
//             ],
//             [
//                 'href' => '#',
//                 'name' => 'sub menu perfil two',
//                 'permission' => '' // add permission key here
//             ]
//         ]
//     ]
// ]
//
// Optional: run 'php artisan optimize' after add new menu or submenu