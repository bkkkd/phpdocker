FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/docker-base:focal


RUN add-apt-repository -y ppa:ondrej/php &&\
    apt-get -y install php7.4-bcmath php7.4-bz2 php7.4-cli \
        php7.4-common php7.4-curl php7.4-fpm php7.4-gd php7.4-mbstring \
        php7.4-mysql  php7.4-sqlite3 php7.4-zip php7.4-xml php7.4-opcache \
        php7.4-dev php7.4-imagick php7.4-swoole php7.4-redis php7.4-memcache \
        php7.4-memcached memcached nginx && \
    /usr/bin/ln -sf /usr/sbin/php-fpm7.4 /usr/sbin/php-fpm  && \
    php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
    curl -sSL https://packages.microsoft.com/config/ubuntu/20.04/prod.list | tee /etc/apt/sources.list.d/microsoft-prod.list &&\
    curl -sSL https://packages.microsoft.com/keys/microsoft.asc |  apt-key add - &&\
    apt-get update && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools && \
    echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc && \
    export PATH="$PATH:/opt/mssql-tools/bin" && \ 
    apt-get install --allow-downgrades -y unixodbc-dev=2.3.7   unixodbc=2.3.7 odbcinst1debian2=2.3.7 odbcinst=2.3.7&& \
    pecl install sqlsrv-5.10.1 && \
    pecl install pdo_sqlsrv-5.10.1 && \
    echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc && \
    apt-get -y full-upgrade && apt-get clean && rm -rf /var/lib/apt/lists/* &&\
    sed -i '/server_tokens off;/aclient_max_body_size 500m;\n' /etc/nginx/nginx.conf && \
    sed -i '/keepalive_timeout/ckeepalive_timeout 600;' /etc/nginx/nginx.conf &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/7.4/fpm/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/7.4/fpm/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/7.4/fpm/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/7.4/fpm/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/7.4/fpm/php.ini &&\
    sed -i '/max_execution_time/cmax_execution_time=600' /etc/php/7.4/cli/php.ini &&\
    sed -i '/max_input_time/cmax_input_time=600' /etc/php/7.4/cli/php.ini &&\
    sed -i '/memory_limit/cmemory_limit=512M' /etc/php/7.4/cli/php.ini &&\
    sed -i '/upload_max_filesize/cupload_max_filesize=512M' /etc/php/7.4/cli/php.ini &&\
    sed -i '/post_max_size/cpost_max_size=512M' /etc/php/7.4/cli/php.ini &&\
    echo "extension=pdo_sqlsrv.so" >/etc/php/7.4/mods-available/pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/7.4/mods-available/pdo_sqlsrv.ini /etc/php/7.4/fpm/conf.d/20-pdo_sqlsrv.ini && \
    /usr/bin/ln -sf /etc/php/7.4/mods-available/pdo_sqlsrv.ini /etc/php/7.4/cli/conf.d/20-pdo_sqlsrv.ini && \
    mkdir -p /app/public /run/php && \
    echo "<?php phpinfo();" >/app/public/index.php && \
    chown www-data:www-data -R /app 
    
  
ADD supervisord-phpfpm.conf /etc/supervisor/conf.d/supervisord-phpfpm.conf
ADD nginx-default /etc/nginx/sites-available/default

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
