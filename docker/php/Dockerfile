FROM php:8.0-fpm-alpine

ARG USER
ARG UID

RUN adduser ${USER} --uid ${UID} --disabled-password
RUN sed -i -e "s/www-data/${USER}/" /usr/local/etc/php-fpm.d/www.conf

RUN apk add git --no-cache

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', '/tmp/composer-setup.php');" \
    && php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('/tmp/composer-setup.php');"

USER ${USER}
