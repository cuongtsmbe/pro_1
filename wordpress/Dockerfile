FROM php:8.0-apache
# install base module
RUN apt update \
    && apt install -y nano libzip-dev zip libpng-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j$(nproc) gd \
  && docker-php-ext-install zip \
  && docker-php-ext-install mysqli \
  && docker-php-ext-install calendar \
  && a2enmod rewrite

# Install extension
RUN docker-php-ext-install pdo pdo_mysql


# enable redis
RUN  pecl install -o -f redis \
  && rm -rf /tmp/pear \
  && docker-php-ext-enable redis
# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# install wp-cli (https://wp-cli.org/)
RUN cd / \
  && curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
  && chmod +x wp-cli.phar \
  && mv wp-cli.phar /usr/local/bin/wp

RUN wp --info

COPY ./ /var/www/html

# increase max (size,time,input) limit 
COPY ./php/php.ini /usr/local/etc/php/php.ini


RUN if [ ! -d /var/www/html/wp-content/uploads ]; then mkdir -p /var/www/html/wp-content/uploads; fi

# set user and group default WordPress
RUN chown -R www-data:www-data /var/www/html

