FROM php:fpm-alpine3.18
RUN docker-php-ext-install pdo_mysql