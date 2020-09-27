FROM php:7.4-fpm

RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

RUN docker-php-ext-install pdo pdo_mysql && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
