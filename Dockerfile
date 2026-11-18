
# Stage 1: Build frontend assets
FROM node:22-bookworm-slim AS frontend

WORKDIR /var/www/html

COPY . .

RUN npm install && npm run build


# Stage 2: Build Laravel application
FROM php:8.4-cli-bookworm

RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev libsqlite3-dev unzip \
    && docker-php-ext-install pdo_pgsql pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./

RUN composer install --no-dev --no-interaction --no-progress --prefer-dist --no-scripts --no-autoloader

COPY . .

# Copy the compiled CSS and JavaScript
COPY --from=frontend /var/www/html/public/build ./public/build

RUN composer dump-autoload --no-dev --optimize \
    && php artisan package:discover \
    && mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

ENTRYPOINT ["sh", "/var/www/html/docker-entrypoint.sh"]
