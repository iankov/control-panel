<?php

return [
    //default route parameters
    'route' => [
        'middleware' => 'icp', //check if have access to control panel (if authorized)
        'prefix-url' => '/control',
        'prefix-name' => 'control.',
        'namespace' => '\Iankov\ControlPanel\Controllers\Control',
    ],

    'panel-default-url' => '/control/admins',
    'skin' => 'blue',

    /*
     * If true, all modules are enabled if not stated other. If false, all modules are disabled if not stated other.
     * To enable/disable module, add 'enabled' => true/false value
     */
    'default-module-activity' => true,
    'modules' => [
        'default' => [
            //'enabled' => true,
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/default.php'),
            ],
        ],
        'auth' => [
            //'enabled' => true,
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/auth.php'),
                'namespace' => '\Iankov\ControlPanel\Controllers\Auth',
                'middleware' => 'web',
                'prefix-url' => '/control/auth',
                'prefix-name' => 'control.auth.'
            ],
            'login-redirect' => '/control',
            'password-reset-redirect' => '/control/auth/login'
        ],
        'admins' => [
            //'enabled' => true,
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/admins.php'),
            ],
            'password-min-length' => 5,
        ],
        'settings' => [
            //'enabled' => true,
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/settings.php'),
            ],
        ],
        'file-manager' => [
            //'enabled' => true,
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/file-manager.php'),
            ],
        ],
    ],

    /*
     * If true, all menu groups are visible if not stated other. If false, all menu groups are invisible if not stated other.
     * To make group visible or invisible, add 'visible' => true/false value
     */
    'default-menu-group-visibility' => true,

    /*
     * If true, all menu items are visible if not stated other. If false, all menu items are invisible if not stated other.
     * To make item visible or invisible, add 'visible' => true/false value
     */
    'default-menu-item-visibility' => true,

    'menu' => [
        'groups' => [
            'basic' => [
                //'visible' => true,
                'title' => 'Basic',
                'icon' => 'bars',
                'items' => [
                    'admins' => [
                        //'visible' => true,
                        'icon' => 'user-circle',
                        'title' => 'Admins',
                        'icp_route' => 'admins'
                    ],
                    'settings' => [
                        //'visible' => true,
                        'icon' => 'gear',
                        'title' => 'Settings',
                        'icp_route' => 'settings'
                    ],
                    'file-manager' => [
                        //'visible' => true,
                        'icon' => 'folder',
                        'title' => 'File Manager',
                        'icp_route' => 'file-manager'
                    ],
                ]
            ],

            'other' => [
                //'visible' => true,
                'title' => 'Other',
                'icon' => 'folder',
                'items' => [

                ]
            ],
        ]
    ],
];