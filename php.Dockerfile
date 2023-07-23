###############################################################################
# Imagem PHP + Apache
# Referência: https://gist.github.com/avandrevitor/bc9b28cba063468eda7bbeee9b485114
#
FROM php:7.2-apache

WORKDIR /var/www/html/

RUN apt-get update --yes

# Install Dependencies
RUN apt-get install --yes \
    curl \
    bzip2 \
    libzip-dev \
    libbz2-dev \
    libxml2-dev \
    git \
    tar \
    unzip \
    zip

# Extensões
RUN docker-php-ext-install bcmath
RUN docker-php-ext-install calendar
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install soap
RUN docker-php-ext-install zip

RUN docker-php-ext-configure intl
RUN docker-php-ext-configure zip --with-libzip;

RUN docker-php-ext-configure opcache
RUN docker-php-ext-install opcache

# Composer#Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer