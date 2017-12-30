Install package
```
 composer require iankov/control-panel:^1.0
```

Update guards, providers, passwords in config/auth.php

```
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

Publish config file

```
php artisan vendor:publish --tag=icp_config
```

Publish public assets
```
php artisan vendor:publish --tag=icp_public
```

Run migrations

```
php artisan migrate --path=vendor/iankov/control-panel/database/migrations
```

Run seeder to insert initial admin user. Login: admin@admin.com, Password: admin

```
php artisan db:seed --class=Iankov\\ControlPanel\\Database\\Seeds\\Admins
```

Elfinder file manager setup, more info here
https://github.com/barryvdh/laravel-elfinder

1. Add the ServiceProvider to the providers array in app/config/app.php

```
Barryvdh\Elfinder\ElfinderServiceProvider::class
``` 

2. You need to copy the assets to the public folder, using the following artisan command:

```
php artisan elfinder:publish
```

3. Publish the config file

```   
php artisan vendor:publish --provider='Barryvdh\Elfinder\ElfinderServiceProvider' --tag=config
```
