#!/bin/bash
# Infinite loop to ensure worker restarts periodically
while true; do
    echo "Starting Laravel queue worker..."
    php artisan queue:work --timeout=3600 --tries=3
    echo "Queue worker stopped. Restarting in 5 seconds..."
    sleep 5
done

