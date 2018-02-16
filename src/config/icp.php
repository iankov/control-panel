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

];