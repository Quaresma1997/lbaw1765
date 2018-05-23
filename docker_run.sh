#!/bin/bash
set -e
 
env >> /var/www/.env
php-fpm7.1 -D
cd /var/www
php artisan db:seed --force
php artisan schedule:run
nginx -g "daemon off;"