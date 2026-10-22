FROM registry.cn-shenzhen.aliyuncs.com/alpicool/docker-base:noble

ENV DEBIAN_FRONTEND=noninteractive

RUN echo "start install tools" && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
        software-properties-common python3-launchpadlib \
        build-essential supervisor ca-certificates curl gnupg && \
    echo "start install php"&& \
    add-apt-repository -y ppa:ondrej/php &&\
    apt-get update &&\
    apt-get -y install php8.2-bcmath php8.2-bz2 php8.2-cli php8.2-common php8.2-curl \
        php8.2-fpm php8.2-gd php8.2-mbstring php8.2-mysql  php8.2-sqlite3 php8.2-zip \
        php8.2-xml php8.2-opcache php8.2-dev php8.2-imagick php8.2-swoole php8.2-redis \
        php8.2-memcache php8.2-memcached php8.2-ssh2 nginx memcached && \
    /usr/bin/ln -sf /usr/sbin/php-fpm8.2 /usr/sbin/php-fpm  && \
    echo "start install composer"&& \
    curl -sSL https://getcomposer.org/download/latest-stable/composer.phar -o /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    echo "start install sqlsrv"&& \
    curl -sSL -O https://packages.microsoft.com/config/ubuntu/$(grep VERSION_ID /etc/os-release | cut -d '"' -f 2)/packages-microsoft-prod.deb &&\
    dpkg -i packages-microsoft-prod.deb &&\
    rm packages-microsoft-prod.deb && \
    apt-get update && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql18 mssql-tools18 unixodbc-dev && \
    echo 'export PATH="$PATH:/opt/mssql-tools18/bin"' >> ~/.bashrc && \
    export PATH="$PATH:/opt/mssql-tools18/bin" && \
    cd /tmp && \
    curl -sSL -o sqlsrv.tgz https://pecl.php.net/get/sqlsrv-5.12.0.tgz && \
    mkdir -p sqlsrv-src && tar -xzf sqlsrv.tgz -C sqlsrv-src --strip-components=1 && \
    cd sqlsrv-src && /usr/bin/phpize8.2 && \
    ./configure --with-php-config=/usr/bin/php-config8.2 && \
    make -j"$(nproc)" && make install && \
    cd /tmp && \
    curl -sSL -o pdo_sqlsrv.tgz https://pecl.php.net/get/pdo_sqlsrv-5.12.0.tgz && \
    mkdir -p pdo_sqlsrv-src && tar -xzf pdo_sqlsrv.tgz -C pdo_sqlsrv-src --strip-components=1 && \
    cd pdo_sqlsrv-src && /usr/bin/phpize8.2 && \
    ./configure --with-php-config=/usr/bin/php-config8.2 && \
    make -j"$(nproc)" && make install && \
    cd /tmp && rm -rf sqlsrv-src pdo_sqlsrv-src sqlsrv.tgz pdo_sqlsrv.tgz && \
    apt-get -y full-upgrade &&\
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* &&\
    sed -i '/keepalive_timeout/ckeepalive_timeout 600;' /etc/nginx/nginx.conf &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/8.2/fpm/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/8.2/fpm/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/8.2/fpm/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/8.2/fpm/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/8.2/fpm/php.ini &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/8.2/cli/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/8.2/cli/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/8.2/cli/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/8.2/cli/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/8.2/cli/php.ini &&\
    echo "extension=pdo_sqlsrv.so" >/etc/php/8.2/mods-available/pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/8.2/mods-available/pdo_sqlsrv.ini /etc/php/8.2/fpm/conf.d/20-pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/8.2/mods-available/pdo_sqlsrv.ini /etc/php/8.2/cli/conf.d/20-pdo_sqlsrv.ini && \
    mkdir -p /app/public /run/php && \
    echo "<?php phpinfo();" >/app/public/index.php && \
    chown www-data:www-data -R /app && \
    echo "check pdo_sqlsrv" && \
    /usr/bin/php8.2 -m | grep -i pdo_sqlsrv && \
    echo "check odbc driver" && \
    odbcinst -q -d | grep -i 18

ADD supervisord-phpfpm.conf /etc/supervisor/conf.d/supervisord-phpfpm.conf
ADD nginx-default /etc/nginx/sites-available/default

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
