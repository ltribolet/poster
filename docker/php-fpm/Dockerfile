FROM php:7.1-fpm

# Dependencies
RUN apt-get update && apt-get install -y \
    libmcrypt-dev git unzip jpegoptim optipng pngquant gifsicle && \
    docker-php-ext-install pdo_mysql mcrypt exif

# Imagemagick
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    libmagickwand-dev \
    libmagickcore-dev \
    imagemagick

RUN pecl install imagick-3.4.3 && docker-php-ext-enable imagick

# Install node
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash
RUN apt-get install -y nodejs
RUN npm install -g yarn@1.3.2
RUN npm install -g svgo

# Install composer
RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# install xdebug
RUN docker-php-ext-install opcache 

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug opcache exif

# configure xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

WORKDIR /var/www/
