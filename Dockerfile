FROM php:8.1-apache

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY . /var/www/html/
COPY php.ini /usr/local/etc/php/php.ini

RUN mkdir -p /var/log/php /var/log/apache2 \
    && touch /var/log/php/error.log /var/log/apache2/error.log /var/log/apache2/access.log \
    && chmod -R 777 /var/log/php /var/log/apache2 \
    && chown -R www-data:www-data /var/log/php /var/log/apache2

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

CMD ["apache2-foreground"]

