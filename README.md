# Restaurant . Laravel Project

version: Laravel v10.48.22 (PHP v8.2.25)

## Настройка и запуск

1. cd docker
2. docker-compose build
3. docker-compose up -d
4. скопировать содержимое .env.example в .env
5. docker-compose exec php php artisan key:generate
6. docker-compose exec php php artisan migrate
7. перейти на http://localhost:8080/
8. для phpMyAdmin: http://localhost:8081/ ; user: root, pwd: root.
