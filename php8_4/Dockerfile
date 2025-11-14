FROM registry.cn-shenzhen.aliyuncs.com/alpicool/docker-base:noble

RUN echo "start install php"&& \
    add-apt-repository -y ppa:ondrej/php &&\
    apt-get -y install php8.4-bcmath php8.4-bz2 php8.4-cli php8.4-common php8.4-curl \
        php8.4-fpm php8.4-gd php8.4-mbstring php8.4-mysql  php8.4-sqlite3 php8.4-zip \
        php8.4-xml php8.4-opcache php8.4-dev php8.4-imagick php8.4-swoole php8.4-redis \
        php8.4-memcache php8.4-memcached php8.4-ssh2 nginx memcached && \
    /usr/bin/ln -sf /usr/sbin/php-fpm8.4 /usr/sbin/php-fpm  && \
    echo "start install composer"&& \
    curl https://getcomposer.org/download/latest-stable/composer.phar -o /usr/local/bin/composer && \
    chmod +x  /usr/local/bin/composer && \
    echo "start install sqlsrv"&& \
    curl -sSL -O https://packages.microsoft.com/config/ubuntu/$(grep VERSION_ID /etc/os-release | cut -d '"' -f 2)/packages-microsoft-prod.deb &&\
    dpkg -i packages-microsoft-prod.deb &&\
    rm packages-microsoft-prod.deb && \
    apt-get update && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql18 mssql-tools18 unixodbc-dev&& \
    echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc && \
    export PATH="$PATH:/opt/mssql-tools/bin" && \
    pecl install sqlsrv && \
    pecl install pdo_sqlsrv && \
    echo "start install sqlsrv"&& \
    apt-get -y full-upgrade &&\
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* &&\
    sed -i '/server_tokens off;/aclient_max_body_size 500m;\n' /etc/nginx/nginx.conf && \
    sed -i '/keepalive_timeout/ckeepalive_timeout 600;' /etc/nginx/nginx.conf &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/8.4/fpm/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/8.4/fpm/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/8.4/fpm/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/8.4/fpm/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/8.4/fpm/php.ini &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/8.4/cli/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/8.4/cli/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/8.4/cli/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/8.4/cli/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/8.4/cli/php.ini &&\
    echo "extension=pdo_sqlsrv.so" >/etc/php/8.4/mods-available/pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/8.4/mods-available/pdo_sqlsrv.ini /etc/php/8.4/fpm/conf.d/20-pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/8.4/mods-available/pdo_sqlsrv.ini /etc/php/8.4/cli/conf.d/20-pdo_sqlsrv.ini && \
    mkdir -p /app/public /run/php && \
    echo "<?php phpinfo();" >/app/public/index.php && \
    chown www-data:www-data -R /app 
    
  
ADD supervisord-phpfpm.conf /etc/supervisor/conf.d/supervisord-phpfpm.conf
ADD nginx-default /etc/nginx/sites-available/default

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
