FROM php:8.3-fpm

ARG uid
ARG user

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libldap2-dev \
    libfreetype6-dev \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    nodejs \
    graphviz \
    fswatch \
    ufw

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ \
    &&  docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql mysqli pdo_pgsql pdo_mysql mbstring zip exif pcntl gd ldap 

RUN ufw allow 9003

RUN pecl install -o -f xdebug \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable xdebug

COPY .infra/php/ /usr/local/etc/php/conf.d

RUN useradd -G root -u $uid -d /home/$user $user

WORKDIR /var/www

COPY . html/


RUN mkdir -p /home/$user/.composer

RUN chown -R $user /home/$user/.composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER $user

EXPOSE 9000

CMD [ "php-fpm" ]