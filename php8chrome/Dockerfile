FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/docker-base:focal

RUN echo "start install php"&& \
    add-apt-repository -y ppa:ondrej/php &&\
    apt-get -y install php8.4-bcmath php8.4-bz2 php8.4-cli php8.4-common php8.4-curl \
        php8.4-fpm php8.4-gd php8.4-mbstring php8.4-mysql  php8.4-sqlite3 php8.4-zip \
        php8.4-xml php8.4-opcache php8.4-dev php8.4-imagick php8.4-swoole php8.4-redis \
        php8.4-memcache php8.4-memcached php8.4-ssh2 nginx memcached && \
    /usr/bin/ln -sf /usr/sbin/php-fpm8.4 /usr/sbin/php-fpm  && \
    echo "start install composer"&& \
    php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer && \
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
    echo "start install chrome"&& \
    wget https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb &&\
    apt install -y ./google-chrome-stable_current_amd64.deb &&\
    apt clean && \
    rm -rf ./google-chown-stable_current_amd64.deb &&\
    rm -rf /etc/supervisor/conf.d/* &&\
    rm -rf /app/* &&\
    apt-get clean
    

COPY etc/supervisord/ /etc/supervisor/conf.d/
COPY etc/nginx/ /etc/nginx/
COPY etc/php/php-fpm.d /etc/php/docker/fpm/pool.d
COPY etc/php/php-fpm.conf /etc/php/docker/fpm/php-fpm.conf
COPY etc/php/php.ini /etc/php/docker/fpm/php.ini
COPY web/ /app/

WORKDIR /app
# 是否测试状态
ENV APP_DEBUG=false
# 数据签名密钥
ENV DEFAULT_DATA_KEY=111111
# 签名有效秒数
ENV SIGN_EFF_SEC=30

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
