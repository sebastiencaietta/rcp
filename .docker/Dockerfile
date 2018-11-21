FROM php:7.1.8-apache

MAINTAINER Paul Redmond

COPY . /srv/app
COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /srv/app

RUN docker-php-ext-install mbstring pdo pdo_mysql \
    && chown -R www-data:www-data /srv/app

RUN pecl install xdebug-2.5.0 && \
    docker-php-ext-enable xdebug

COPY .docker/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini


ENV TERM xterm

RUN a2enmod rewrite
RUN a2enmod headers
RUN cat .docker/apache2.conf >> /etc/apache2/apache2.conf
#RUN sed -i '/<Directory \/srv\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
#RUN sed -i '/#<Directory \/srv\/>/,/#<\/Directory>/ s/^#//' /etc/apache2/apache2.conf
CMD ["/usr/sbin/apache2ctl","-DFOREGROUND"]
