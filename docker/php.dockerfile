FROM php:8.2-fpm-alpine

# Установка необходимых PHP расширений
RUN apk --no-cache update \
    && apk --no-cache add \
        autoconf \
        g++ \
        make \
        openssl-dev

# Установка расширений PHP
RUN pecl install redis \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pdo pdo_mysql

# Копирование Composer из официального образа
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# CMD ["php-fpm"]

# Установим umask для создания файлов с правами 777
RUN echo "umask 0000" >> /etc/profile

# Устанавливаем права на проект при старте контейнера
CMD chmod -R 777 /var/www && php-fpm