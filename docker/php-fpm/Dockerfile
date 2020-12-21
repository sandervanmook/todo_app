FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y curl libzip-dev zlib1g-dev libpq-dev git libicu-dev libxml2-dev && docker-php-ext-configure intl && docker-php-ext-install intl && docker-php-ext-install pdo pdo_mysql && docker-php-ext-install zip xml

RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime
RUN "date"

WORKDIR /var/www/symfony