FROM php:7.3-fpm-alpine

RUN apk update \
 && apk add curl \
wget \
git \
libxslt-dev \
libxml2-dev \
freetype-dev \
libjpeg-turbo-dev \
libpng-dev \
icu-dev \
libzip-dev \

&& docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql bcmath zip \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd



RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install xsl
RUN docker-php-ext-install soap

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD bash -c "composer install && php artisan serve --host 0.0.0.0 --port 5001"

ADD /docker/php-fpm/php.ini /usr/local/etc/php/conf.d/40-custom.ini

CMD ["php-fpm"]