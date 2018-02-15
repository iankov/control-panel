# Installation

```bash
 composer require iankov/control-panel
```

* Update guards, providers, passwords in `config/auth.php`

    ```php
    'guards' => [
        ...
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],
    'providers' => [
        ...
        'admins' => [
            'driver' => 'eloquent',
            'model' => Iankov\ControlPanel\Models\Admin::class,
        ],
    ],
    'passwords' => [
        ...
        'admins' => [
            'provider' => 'admins',
            'table' => 'admin_password_resets',
            'expire' => 60,
        ],
    ],
    ```

* Publish config file
    ```bash
    php artisan vendor:publish --tag=icp_config
    ```

* Publish public assets
    ```bash
    php artisan vendor:publish --tag=icp_public
    ```

* Run migrations

    ```bash
    php artisan migrate --path=vendor/iankov/control-panel/database/migrations
    ```

* Run seeder to insert initial admin user. Login: admin@admin.com, Password: admin

    ```bash
    php artisan db:seed --class=Iankov\\ControlPanel\\Database\\Seeds\\Admins
    ```

## Elfinder file manager integration

[Laravel elfinder package](https://github.com/barryvdh/laravel-elfinder) 

[Configuration options](https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1)

 * Add the ServiceProvider to the providers array in `app/config/app.php`

    ```php
    Barryvdh\Elfinder\ElfinderServiceProvider::class
    ``` 

 * You need to copy the assets to the public folder, using the following artisan command:

    ```bash
    php artisan elfinder:publish
    ```
 * Copy `vendor/iankov/control-panel/public/packages/barryvdh` to `public/barryvdh`.
    You can do this by publishing iankov/control-panel assets
    ```bash
    php artisan vendor:publish --tag=icp_public
    ```

 * Publish the config file

    ```bash
    php artisan vendor:publish --provider='Barryvdh\Elfinder\ElfinderServiceProvider' --tag=config
    ```

 * Change elfinder config

    ```php
        'route' => [
            'prefix' => 'control/elfinder',
            'middleware' => 'icp', //Set to null to disable middleware filter
        ],
        
        //required for default ckeditor integration: images/files browse/upload
        'roots' => [
            'images' => [
                'alias' => '/images',
                'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                'path' => public_path('images'), // path to files (REQUIRED)
                'URL' => '/images', // URL to files (REQUIRED)
                'uploadOrder' => ['allow', 'deny'],
                'uploadAllow' => ['image'], # allow any images
            ],
            'root' => [
                'alias' => '/',
                'driver' => 'LocalFileSystem', // driver for accessing file system (REQUIRED)
                'path' => public_path(''), // path to files (REQUIRED)
                'URL' => '/', // URL to files (REQUIRED)
            ]
        ],
        
        //default options for all roots
        'root_options' => array(
            'accessControl' => '', // filter callback (OPTIONAL)
            'tmbURL' => '/_tmb',
            'tmbPath' => public_path('_tmb').'/',
        ),
    ```

 * Create 'images' folder in your public dir to match `roots.images` config path
