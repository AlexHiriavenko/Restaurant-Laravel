# Restaurant. Laravel Project. Backend.

version: Laravel v10.48.22 (PHP v8.2.25)

## Project URLs:

-   клиентская часть: https://alexhiriavenko.github.io/Restaurant-Vue/
-   админ панель:https://restaurant-laravel-production.up.railway.app/

## Описание

-   Тема: Платформа для автоматизации ресторана
-   Функционал: заказы блюд, бронирования столиков, аналитика, формирование и отправка отчетов, real-time уведомления.

## Frontend чать

-   клиентская часть реализована в репозитории [Restaurant-Vue](https://github.com/AlexHiriavenko/Restaurant-Vue) и запускается на http://localhost:5173/Restaurant-Vue/ (адрес задан жестко если этот порт занят будет ошибка);
-   админ панель реализована на Blade шаблонах и доступна по url: http://localhost:8080/ (ветка main) ; https://localhost:8443/ (ветка ws) .

## Доп Инфо

-   в ветке ws реализованы пуш сообщения через Pusher - относится к обоим репозиториям.
-   в проекте используется Docker. cм 'Настройка и запуск'.
-   сидеры заполняют БД в рамках периода - декабрь 2024г. При необходимости отредактируйте даты.

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
12. перейти на http://localhost:8080/ если используете ветку main или на https://localhost:8443/ если используете ветку ws
13. для phpMyAdmin: http://localhost:8081/ ; user: root, pwd: root.
14. Если вам понадобиться помощь в запуске проекта ищите мои контакты на главной странице.

## Примеры Полезных команд artisan:

-   docker-compose exec php php artisan migrate:reset
-   docker-compose exec php php artisan migrate --seed
-   docker-compose exec php php artisan migrate
-   docker-compose exec php php artisan db:seed
-   docker-compose exec php php artisan db:seed --class=RoleSeeder
-   docker-compose exec php php artisan route:clear
-   docker-compose exec php php artisan config:clear
-   docker-compose exec php php artisan cache:clear
-   docker-compose exec php sh -c "php artisan route:clear && php artisan config:clear && php artisan cache:clear"
-   docker-compose exec php php artisan queue:work
-   docker-compose exec php php artisan queue:restart
-   composer dump-autoload

## Юзеры из бд

-   email: admin@admin.com; pwd: admin; (все права доступа)
-   email: manager@manager.com; pwd: manager; (частичные права доступа)
-   email: client@client.com; pwd: client; (пользовательские права доступа)

## Настройте в .env правильно переменные для дев либо прод версии:

-   все переменне `MAIL\`. Текущие настройки предназначены для работы c [sendgrid](https://sendgrid.com/en-us). Значение для MAIL_PASSWORD это ваш sengrid api_key, который можно бесплатно получить после регистрации. Вы можете выбрать другой сервис для отправки email.
-   если отправка почты через sendgrid не работает попробуйте изменить значения переменнных MAIL_PORT=465 и MAIL_ENCRYPTION=ssl (отправка сообщений происходит только при запущеном worker: docker-compose exec php php artisan queue:work)
-   все переменные`DB_`. Для локальной дев версии можно оставить текущие настройки, для продакшн настройте эти переменные в зависимости от вашего хостинга на котором размещается бекенд.
-   переменная `FRONTEND_URL_PROD` в зависимости от вашего хостинга на котором размещается клиентская часть. При `FRONTEND_URL_DEV=http://localhost:5173`; ваше фронтенд приложение должно использовать `http://localhost:5173` соответсвенно.
-   APP_URL=http://localhost:8080 если ветка main; APP_URL=https://localhost:8443/ если ветка ws.
-   при смене переменных окружения выполняйте команду: <br>
    docker-compose exec php sh -c "php artisan route:clear && php artisan config:clear && php artisan cache:clear"
