Publish config file/files:
"php artisan vendor:publish --tag=icp_config",

Migrations:
"php artisan migrate --path=vendor/iankov/control-panel/database/migrations",

DB seed, insert initial admin user:
"php artisan db:seed --class=Iankov\\ControlPanel\\Database\\Seeds\\Admins",

"php artisan route:clear",
"php aritsan config:clear"