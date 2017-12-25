<p>1. Install package</p>
<p>2. Update guards, providers, passwords in config/auth.php</p>

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

<p>3. Publish config file</p>

```
php artisan vendor:publish --tag=icp_config
```

<p>4. Run migrations</p>

```
php artisan migrate --path=vendor/iankov/control-panel/database/migrations
```

<p>5. Run seeder to insert initial admin user. Login: admin@admin.com, Password: admin</p>

```
php artisan db:seed --class=Iankov\\ControlPanel\\Database\\Seeds\\Admins
```
