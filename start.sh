composer install
composer dump-autoload

php artisan key:generate
php artisan migrate:fresh

php artisan db:seed

php artisan optimize:clear