FROM php:7.4-fpm-alpine

RUN apk update && apk add --no-cache supervisor icu-dev

RUN docker-php-ext-install pdo pdo_mysql intl