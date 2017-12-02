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

    'modules' => [
        'default' => [
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/default.php'),
            ],
        ],
        'auth' => [
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
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/admins.php'),
            ],
            'password-min-length' => 5,
        ],
        'settings' => [
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/settings.php'),
            ],
        ],
        'static' => [
            'route' => [
                'path' => base_path('vendor/iankov/control-panel/src/routes/static.php'),
            ],
        ]
    ],

    'menu' => [
        [
            'icon' => 'user-circle',
            'title' => 'Admins',
            'icp_route' => 'admins'
        ],
        [
            'icon' => 'wrench',
            'title' => 'Settings',
            'icp_route' => 'settings'
        ],
        [
            'icon' => 'file',
            'title' => 'Static',
            'icp_route' => 'static'
        ],
    ],
];