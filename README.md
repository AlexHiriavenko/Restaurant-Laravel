# Restaurant . Laravel Project

version: Laravel v10.48.22 (PHP v8.2.25)

## Настройка и запуск

1. cd docker
2. docker-compose build
3. docker-compose up -d
4. скопировать содержимое .env.example в .env: `cd ..`, `cp .env.example .env`, `cd docker`. См [инструкцию в конце RedMe](#настройте-в-env-правильно-переменные-для-дев-либо-прод-версии).
5. установить зависимости: `docker-compose -f docker-compose.yml run composer install --ignore-platform-reqs`
6. docker-compose exec php php artisan key:generate
7. docker-compose exec php php artisan migrate --seed
8. docker-compose exec php php artisan storage:link
9. для wsl ubuntu или linux выполнить команду из корня проекта (вернитесь из docker в корень `cd ..`): <br>
   sudo chmod 777 -R./
10. из корня проекта выполнить npm i
11. из корня проекта выполнить npm run dev
12. перейти на http://localhost:8080/
13. для phpMyAdmin: http://localhost:8081/ ; user: root, pwd: root.

## Примеры Полезных команд artisan:

-   docker-compose exec php php artisan migrate:reset
-   docker-compose exec php php artisan migrate --seed
-   docker-compose exec php php artisan migrate
-   docker-compose exec php php artisan db:seed
-   docker-compose exec php php artisan db:seed --class=RoleSeeder
-   docker-compose exec php php artisan route:clear
-   docker-compose exec php php artisan config:clear
-   docker-compose exec php php artisan cache:clear
-   composer dump-autoload

## Юзеры из бд

-   email: admin@admin.com; pwd: admin;
-   email: manager@manager.com; pwd: manager;
-   email: client@client.com; pwd: client;

## Настройте в .env правильно переменные для дев либо прод версии:

-   все `MAIL\`. Текущие настройки предназначены для работы sendgrid. Значение MAIL_PASSWORD (sengrid api_key) можно получить при бесплатной регистрации на sendgrid. Либо используйте любой другой сервис.
-   все `DB_` для локальной дев версии можно оставить текущие настройки, для прод настройте эти переменные в зависимости от вашего хостинга на котором размещается бекенд.
-   переменная `FRONTEND_URL_PROD` в зависимости от вашего хостинга на котором размещается клиентская часть.
-   при `FRONTEND_URL_DEV=http://localhost:5174`; ваше фронтенд приложение должно использовать `http://localhost:5174` соответсвенно.
