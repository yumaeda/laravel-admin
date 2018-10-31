FROM php:7.2-fpm

RUN DEBIAN_FRONTEND=noninteractive \
    && apt-get update \
    && apt-get install -y mysql-client unzip git curl

RUN git clone https://github.com/nikic/php-ast.git \
    && cd php-ast \
    && phpize \
    && ./configure \
    && make install \
    && echo 'extension=ast.so' > /usr/local/etc/php/php.ini \
    && cd .. && rm -rf php-ast

RUN docker-php-ext-install pdo_mysql
