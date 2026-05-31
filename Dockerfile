# /home/lenovo/work/projects/the_picksto/picksto/Dockerfile
FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev zip curl \
    && docker-php-ext-install pdo pdo_mysql zip

RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . .

RUN chown -R www-data:www-data /var/www

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
