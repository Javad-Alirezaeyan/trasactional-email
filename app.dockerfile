FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev \
    vim \
    unzip \
    git \
    mariadb-client libmagickwand-dev --no-install-recommends \
    && docker-php-ext-install  pdo_mysql


RUN apt-get install -y nodejs npm