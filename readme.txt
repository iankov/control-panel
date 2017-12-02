1. Install package
2. Update guards, providers, passwords in config/auth.php
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


3. Publish config file
"php artisan vendor:publish --tag=icp_config",

4. Run migrations
"php artisan migrate --path=vendor/iankov/control-panel/database/migrations",

5. Run seeder to insert initial admin user. Login: admin@admin.com, Password: admin
"php artisan db:seed --class=Iankov\\ControlPanel\\Database\\Seeds\\Admins",

"php artisan route:clear",
"php aritsan config:clear"