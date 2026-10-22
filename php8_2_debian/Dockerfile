FROM php:8.2-fpm-bookworm

ENV DEBIAN_FRONTEND=noninteractive

RUN echo "start install system packages" && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
        nginx supervisor memcached \
        libbz2-dev libzip-dev \
        libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
        libmagickwand-dev libmemcached-dev zlib1g-dev \
        libssh2-1-dev unixodbc-dev \
        ca-certificates curl && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN echo "start install php extensions" && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j"$(nproc)" bcmath bz2 gd mysqli pdo_mysql zip opcache && \
    echo "start install pecl extensions" && \
    yes '' | pecl install redis && \
    yes '' | pecl install imagick && \
    yes '' | pecl install memcached && \
    yes '' | pecl install memcache && \
    yes '' | pecl install ssh2 && \
    yes '' | pecl install swoole && \
    docker-php-ext-enable redis imagick memcached memcache ssh2 swoole && \
    rm -rf /tmp/pear

RUN echo "start install sqlsrv driver" && \
    curl -sSL -O https://packages.microsoft.com/config/debian/12/packages-microsoft-prod.deb && \
    dpkg -i packages-microsoft-prod.deb && \
    rm packages-microsoft-prod.deb && \
    apt-get update && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql18 mssql-tools18 && \
    pecl install sqlsrv && \
    pecl install pdo_sqlsrv && \
    docker-php-ext-enable sqlsrv pdo_sqlsrv && \
    rm -rf /tmp/pear && \
    echo "start install composer" && \
    curl -sSL https://getcomposer.org/download/latest-stable/composer.phar -o /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

RUN echo "start config php" && \
    cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    sed -i 's/^max_execution_time = .*/max_execution_time = 600/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/^max_input_time = .*/max_input_time = 600/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/^memory_limit = .*/memory_limit = 512M/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/^upload_max_filesize = .*/upload_max_filesize = 512M/' "$PHP_INI_DIR/php.ini" && \
    sed -i 's/^post_max_size = .*/post_max_size = 512M/' "$PHP_INI_DIR/php.ini" && \
    sed -i '/keepalive_timeout/ckeepalive_timeout 600;' /etc/nginx/nginx.conf && \
    mkdir -p /app/public && \
    echo "<?php phpinfo();" >/app/public/index.php && \
    chown www-data:www-data -R /app

ADD supervisord-phpfpm.conf /etc/supervisor/conf.d/supervisord-phpfpm.conf
ADD nginx-default /etc/nginx/sites-available/default

ENV PATH="/opt/mssql-tools18/bin:${PATH}"

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
