FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/docker-base:focal

RUN echo "start install php"&& \
    add-apt-repository -y ppa:ondrej/php &&\
    apt-get -y install php8.1-bcmath php8.1-bz2 php8.1-cli php8.1-common php8.1-curl \
        php8.1-fpm php8.1-gd php8.1-mbstring php8.1-mysql  php8.1-sqlite3 php8.1-zip \
        php8.1-xml php8.1-opcache php8.1-dev php8.1-imagick php8.1-swoole php8.1-redis \
        php8.1-memcache php8.1-memcached nginx memcached && \
    /usr/bin/ln -sf /usr/sbin/php-fpm8.1 /usr/sbin/php-fpm  && \
    echo "start install composer"&& \
    php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    echo "start install sqlsrv"&& \
    curl -sSL https://packages.microsoft.com/config/ubuntu/20.04/prod.list | tee /etc/apt/sources.list.d/microsoft-prod.list &&\
    curl -sSL https://packages.microsoft.com/keys/microsoft.asc |  apt-key add - &&\
    apt-get update && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools && \
    echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc && \
    export PATH="$PATH:/opt/mssql-tools/bin" && \
    apt-get install --allow-downgrades -y unixodbc-dev=2.3.7   unixodbc=2.3.7 odbcinst1debian2=2.3.7 odbcinst=2.3.7&& \
    pecl install sqlsrv && \
    pecl install pdo_sqlsrv && \
    echo "start install sqlsrv"&& \
    apt-get -y full-upgrade &&\
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* &&\
    sed -i '/server_tokens off;/aclient_max_body_size 500m;\n' /etc/nginx/nginx.conf && \
    sed -i '/keepalive_timeout/ckeepalive_timeout 600;' /etc/nginx/nginx.conf &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/8.1/fpm/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/8.1/fpm/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/8.1/fpm/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/8.1/fpm/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/8.1/fpm/php.ini &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/8.1/cli/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/8.1/cli/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/8.1/cli/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/8.1/cli/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/8.1/cli/php.ini &&\
    echo "extension=pdo_sqlsrv.so" >/etc/php/8.1/mods-available/pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/8.1/mods-available/pdo_sqlsrv.ini /etc/php/8.1/fpm/conf.d/20-pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/8.1/mods-available/pdo_sqlsrv.ini /etc/php/8.1/cli/conf.d/20-pdo_sqlsrv.ini && \
    mkdir -p /app/public /run/php && \
    echo "<?php phpinfo();" >/app/public/index.php && \
    chown www-data:www-data -R /app 
    
  
ADD supervisord-phpfpm.conf /etc/supervisor/conf.d/supervisord-phpfpm.conf
ADD nginx-default /etc/nginx/sites-available/default

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
