FROM php:7.2.3-fpm

RUN echo 'deb http://httpredir.debian.org/debian jessie contrib' >> /etc/apt/sources.list

RUN apt-get update
RUN export DEBIAN_FRONTEND=noninteractive && apt-get install -y --force-yes zlib1g-dev libpq-dev libssl-dev curl  libcurl4-gnutls-dev libxml2-dev libicu-dev libmcrypt4 libmemcached11 openssl
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

#CONFIGURAÇÕES DO OPCACHE
RUN docker-php-ext-install opcache

#CONFIGURAÇÕES DO APCU
RUN pecl install apcu-5.1.5 && docker-php-ext-enable apcu

#LIBS EXTRAS
RUN docker-php-ext-install bcmath
RUN apt-get install -y libbz2-dev
RUN docker-php-ext-install bz2
#RUN docker-php-ext-install zlib-dev
RUN docker-php-ext-install mbstring
RUN apt-get install -y libpq-dev
RUN apt-get install -y libicu-dev
#RUN docker-php-ext-configure zip --with-zlib-dir=/usr/include
RUN docker-php-ext-install intl
RUN docker-php-ext-install bz2
RUN docker-php-ext-install zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

#GD
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng16-16
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install gd

#PDO - CUSTOMIZAR A SEU DISPOR
RUN docker-php-ext-install pdo pdo_mysql
#POSTGRE INSTALL
RUN docker-php-ext-install pdo pdo_pgsql

COPY php.ini /usr/local/etc/php/php.ini

# install composer.
RUN mkdir /.composer && mkdir /.composer/cache && chmod 777 -R /.composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

# install git - TO INSTALL COMPOSER REPOSITORYES
RUN apt-get install -y git

RUN apt-get update -y
RUN apt-get install -my wget gnupg build-essential curl

EXPOSE 9000
CMD ["php-fpm"]
