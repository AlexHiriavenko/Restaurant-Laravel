# Restaurant . Laravel Project

version: Laravel v10.48.22 (PHP v8.2.25)

## Настройка и запуск

1. cd docker
2. docker-compose build
3. docker-compose up -d
4. установить зависимости: `docker-compose -f docker-compose.yml run composer install --ignore-platform-reqs`
5. скопировать содержимое .env.example в .env: `cp .env.example .env`
6. docker-compose exec php php artisan key:generate
7. docker-compose exec php php artisan migrate --seed
8. docker-compose exec php php artisan storage:link
9. для wsl ubuntu или linux выполнить команду из корня проекта (вернитесь из docker в корень `cd ..`): <br>
   sudo chmod 777 -R./
10. перейти на http://localhost:8080/
11. для phpMyAdmin: http://localhost:8081/ ; user: root, pwd: root.

## Полезные команды:

-   docker-compose exec php php artisan migrate:reset
-   docker-compose exec php php artisan migrate
-   docker-compose exec php php artisan db:seed
-   docker-compose exec php php artisan migrate --seed
