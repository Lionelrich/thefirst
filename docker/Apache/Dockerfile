FROM php:8.0-apache

COPY camaleao.local.conf /etc/apache2/sites-available/

RUN a2ensite camaleao.local && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN apt-get update && \
    apt-get install git libpng-dev libonig-dev \
    libzip-dev  zlib1g-dev postgresql postgresql-contrib libpq-dev -y

RUN docker-php-ext-install calendar pdo_mysql mysqli zip gd pdo_pgsql pgsql

RUN echo "www-data ALL=NOPASSWD: /usr/bin/php, /usr/bin/python2.7, /usr/bin/python2" >> /etc/sudoers

ENV APACHE_RUN_USER camaleao

RUN useradd -d /var/www --uid=1000 --group=www-data -s /sbin/nologin camaleao