<?php

return [
    'name' => 'Book',
    'menus' => [
        'book' => [
            'icon' => '',
            'name' => 'book::book.name',
            'route' => 'book.index',
            'active' => 'book.*',
            'permission' => null,
            'submenus' => []
        ]
    ]
];

// Example menu with submenus
//
// 'menus' => [
//     'book' => [
//         'icon' => '', // add icon key here. see https://blade-ui-kit.com/blade-icons
//         'name' => 'book::book.menu', // if you use a translation file
//         'route' => 'book.index',
//         'active' => 'book.*',
//         'permission' => null, // add permission key here, remember this is a string
//         'submenus' => [
//             [
//                 'href' => 'book.route', // dont forget create route before in web.php
//                 'name' => 'sub menu book one', // if you use a translation file use 'book::book.sub-menu' or something
//                 'permission' => '' // add permission key here
//             ],
//             [
//                 'href' => '#',
//                 'name' => 'sub menu book two', // if you use a translation file use 'book::book.sub-menu' or something
//                 'permission' => '' // add permission key here
//             ]
//         ]
//     ]
// ]
//
// Optional: run 'php artisan optimize' after add new menu or submenu
