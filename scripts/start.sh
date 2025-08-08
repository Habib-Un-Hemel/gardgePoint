#!/usr/bin/env bash

# Install Composer dependencies if not already installed
composer install --no-interaction --prefer-dist --optimize-autoloader

# Run Laravel migrations
php artisan migrate

# Start Laravel server on 0.0.0.0:$PORT
php artisan serve --host=0.0.0.0 --port=$PORT