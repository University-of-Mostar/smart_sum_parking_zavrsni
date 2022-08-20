# Step 1 - Install php dependencies and dump optimized autoloader
FROM composer:2.3 AS composer_build

WORKDIR /app

COPY composer.* ./
RUN composer install --no-interaction --no-scripts --no-dev --no-autoloader

COPY . ./
RUN composer dump-autoload --optimize

# Step 2 - Install node dependencies and compile assets
FROM node:16.16-slim AS node_build

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . ./
RUN npm run prod

# Step 3 - Build final docker image
FROM php:8.1-fpm-alpine

RUN apk update && apk upgrade && \
    docker-php-ext-install bcmath pdo_mysql

WORKDIR /app

COPY --from=composer_build /app ./
COPY --from=node_build /app/public ./public
