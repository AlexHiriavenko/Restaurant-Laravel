#!/bin/bash
# Make sure this file has executable permissions, run `chmod +x build-app.sh`

# Install PHP dependencies for production
composer install --optimize-autoloader --no-dev

# Install JS dependencies and build assets
npm ci && npm run build

# Clear cache
php artisan optimize:clear

# Cache configuration, routes, and views
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Create symbolic link for storage
php artisan storage:link
