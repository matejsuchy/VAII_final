FROM php:8.0-fpm-alpine

RUN apk add --update npm
RUN npm install

RUN docker-php-ext-install pdo pdo_mysql

RUN apk add bash
RUN echo "export PATH=$PATH:~/.config/composer/vendor/bin" >> ~/.bashrc

RUN curl -sS getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer global require laravel/installer
