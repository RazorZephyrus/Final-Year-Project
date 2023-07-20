composer dump-autoload

php artisan route:cache
php artisan route:clear
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear

php artisan migrate --force
php artisan passport:install --force
php artisan key:generate --force
php artisan db:seed --class=Database\Seeders\RoleSeeder

php artisan responsecache:clear
