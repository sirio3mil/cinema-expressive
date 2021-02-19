FROM reynier3mil/centos-php-fpm-msphpsql:latest
WORKDIR /usr/share/nginx/html/api
COPY . .
RUN composer install --no-dev --ignore-platform-req=php

FROM reynier3mil/centos-php-fpm-msphpsql:latest
WORKDIR /usr/share/nginx/html/api
COPY . .
RUN chown -R nginx:nginx .
COPY --from=0 /usr/share/nginx/html/api/vendor vendor/
COPY ./docker/nginx /etc/nginx/
COPY ./docker/cert /etc/ssl/
COPY ./docker/php-fpm /etc/
RUN rm -f ./config/autoload/development.local.php && \
    rm -f ./config/development.config.php && \
    rm -f /etc/php.d/15-xdebug.ini
