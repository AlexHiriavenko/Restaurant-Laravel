# Restaurant . Laravel Project

version: Laravel v10.48.22 (PHP v8.2.25)

## Настройка и запуск

1. cd docker
2. docker-compose build
3. docker-compose up -d
4. установить зависимости: docker-compose -f docker-compose.yml run composer install --ignore-platform-reqs <br>
   4.1. если проблеммы с установкой зависимостей попробуйте изменить путь в docker-compose.yml в composer: volumes: как <br>

`- ../:/app`
вместо
`- .:/app`
и повторите команду <br>
docker-compose -f docker-compose.yml run composer install --ignore-platform-reqs

5. скопировать содержимое .env.example в .env
6. docker-compose exec php php artisan key:generate
7. docker-compose exec php php artisan migrate
8. перейти на http://localhost:8080/
9. для phpMyAdmin: http://localhost:8081/ ; user: root, pwd: root.
