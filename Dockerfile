FROM php:8.0.8-fpm-alpine3.13

ENV COMPOSER_ALLOW_SUPERUSER="1"

ENV PERMANENT_DEPS \
    postgresql-dev \
    composer \
    nginx

RUN set -e \
    && apk add --quiet --no-cache ${PERMANENT_DEPS} > /dev/null \
    && docker-php-ext-install -j$(nproc) pdo_pgsql sockets bcmath intl > /dev/null \
    && docker-php-ext-configure bcmath --enable-bcmath > /dev/null \
    && rm -rf /var/cache/apk/* \
    && mkdir /app /home/user /run/nginx

COPY ./docker/nginx/conf.d/ /etc/nginx/conf.d/
COPY ./docker/.htpasswd /usr/local/.htpasswd
COPY ./docker/php/custom.ini /usr/local/etc/php/conf.d/docker-php-custom.ini
COPY --chown=www-data:www-data . /app

ENV DB_CONNECTION pgsql

WORKDIR /app

RUN set -e \
    && composer install -n --no-ansi


EXPOSE 5000
