FROM php:7.4-fpm

RUN docker-php-ext-install pdo pdo_mysql | curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
