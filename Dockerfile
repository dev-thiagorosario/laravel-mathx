# syntax=docker/dockerfile:1.4

FROM php:8.2-fpm AS base

ARG UID=1000
ARG GID=1000

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        curl \
        zip \
        unzip \
        libpq-dev \
        libzip-dev \
        libpng-dev \
        libonig-dev \
        libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_pgsql zip intl \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the application code for production images. During development the
# project directory is mounted over this location by docker-compose.
COPY . .

RUN groupadd -g ${GID} laravel || true \
    && useradd -u ${UID} -g laravel -m laravel || true \
    && chown -R laravel:laravel /var/www/html \
    && composer install --no-ansi --no-dev --no-interaction --prefer-dist --no-progress

USER laravel

CMD ["php-fpm"]
