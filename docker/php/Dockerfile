FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libicu-dev \
    libcurl4-gnutls-dev \
    libmcrypt-dev

RUN docker-php-ext-install xml
RUN docker-php-ext-install json
RUN docker-php-ext-install intl
RUN docker-php-ext-install curl

ENV APP_ENV docker