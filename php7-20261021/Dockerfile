# ---------- 编译阶段：只负责编译，不进入最终镜像 ----------
FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/docker-base:focal AS builder

# 源码分支：PHP-7.4-CVE-2026-109618-109619（固定到该分支当前 commit）
ARG PHP_COMMIT=712e60f9edfd03f0960fc4fc3c2c375f42b90aa2

RUN echo "start install build deps" && \
    echo 'Acquire::Retries "5";' > /etc/apt/apt.conf.d/80-retries && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
        build-essential autoconf bison re2c pkg-config \
        libxml2-dev libsqlite3-dev libcurl4-openssl-dev libonig-dev \
        libpng-dev libjpeg-turbo8-dev libfreetype6-dev libzip-dev libbz2-dev \
        libssl-dev libreadline-dev libsodium-dev libxslt1-dev gettext \
        libffi-dev libmagickwand-dev libmemcached-dev zlib1g-dev libssh2-1-dev \
        ca-certificates curl gnupg unzip && \
    echo "start install sqlsrv headers" && \
    curl -sSL https://packages.microsoft.com/config/ubuntu/20.04/prod.list | tee /etc/apt/sources.list.d/microsoft-prod.list && \
    curl -sSL https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    apt-get update && \
    apt-get install --allow-downgrades -y libodbc1=2.3.7 unixodbc-dev=2.3.7 unixodbc=2.3.7 odbcinst1debian2=2.3.7 odbcinst=2.3.7 && \
    echo "start build php7.4" && \
    cd /tmp && \
    curl -sSL --retry 5 -o php.tar.gz https://github.com/php/php-src/archive/${PHP_COMMIT}.tar.gz && \
    mkdir -p php-src && tar -xzf php.tar.gz -C php-src --strip-components=1 && \
    cd php-src && \
    ./buildconf --force && \
    ./configure --prefix=/usr/local \
        --with-config-file-path=/usr/local/etc/php \
        --with-config-file-scan-dir=/usr/local/etc/php/conf.d \
        --disable-cgi \
        --enable-fpm --with-fpm-user=www-data --with-fpm-group=www-data \
        --enable-mysqlnd --with-mysqli=mysqlnd --with-pdo-mysql=mysqlnd \
        --with-sqlite3 --with-pdo-sqlite \
        --with-curl --with-openssl --with-zlib --with-bz2 \
        --with-sodium --with-xsl --with-gettext --with-readline --with-ffi \
        --enable-bcmath --enable-exif \
        --enable-sockets --enable-pcntl --enable-ftp \
        --enable-shmop --enable-sysvmsg --enable-sysvsem --enable-sysvshm \
        --enable-calendar \
        --enable-gd --with-freetype --with-jpeg \
        --enable-mbstring \
        --with-zip \
        --enable-opcache \
        --with-pear && \
    make -j"$(nproc)" && \
    make install && \
    echo "start config php" && \
    mkdir -p /usr/local/etc/php/conf.d && \
    cp php.ini-production /usr/local/etc/php/php.ini && \
    cp /usr/local/etc/php-fpm.conf.default /usr/local/etc/php-fpm.conf && \
    cp /usr/local/etc/php-fpm.d/www.conf.default /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's#^listen = 127.0.0.1:9000#listen = /run/php/php7.4-fpm.sock#' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's/^user = nobody/user = www-data/' /usr/local/etc/php-fpm.d/www.conf && \
    sed -i 's/^group = nobody/group = www-data/' /usr/local/etc/php-fpm.d/www.conf && \
    echo "listen.owner = www-data" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "listen.group = www-data" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "listen.mode = 0660" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "zend_extension=opcache.so" > /usr/local/etc/php/conf.d/10-opcache.ini && \
    cd /tmp && rm -rf php-src php.tar.gz && \
    echo "start install composer" && \
    curl -sSL --retry 5 https://install.phpcomposer.com/installer -o /tmp/composer-setup.php && \
    cd /tmp && /usr/local/bin/php composer-setup.php --filename=composer.phar && \
    mv /tmp/composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer && \
    /usr/local/bin/php -r "unlink('/tmp/composer-setup.php');" && \
    cd /tmp && \
    echo "start install pecl extensions" && \
    for pkg in imagick-3.5.1 redis-6.0.2 memcache-4.0.5.2 memcached-3.2.0 \
               ssh2-1.3.1 igbinary-3.2.7 swoole-4.8.13 \
               sqlsrv-5.10.1 pdo_sqlsrv-5.10.1; do \
        echo "start install ${pkg}" && \
        curl -fsSL --retry 5 -o /tmp/pecl.tgz "https://pecl.php.net/get/${pkg}.tgz" && \
        yes '' | pecl install /tmp/pecl.tgz || exit 1; \
    done && \
    echo "extension=imagick.so" > /usr/local/etc/php/conf.d/20-imagick.ini && \
    echo "extension=redis.so" > /usr/local/etc/php/conf.d/20-redis.ini && \
    echo "extension=memcache.so" > /usr/local/etc/php/conf.d/20-memcache.ini && \
    echo "extension=memcached.so" > /usr/local/etc/php/conf.d/20-memcached.ini && \
    echo "extension=ssh2.so" > /usr/local/etc/php/conf.d/20-ssh2.ini && \
    echo "extension=igbinary.so" > /usr/local/etc/php/conf.d/20-igbinary.ini && \
    echo "extension=swoole.so" > /usr/local/etc/php/conf.d/20-swoole.ini && \
    echo "extension=pdo_sqlsrv.so" > /usr/local/etc/php/conf.d/20-pdo_sqlsrv.ini && \
    sed -i 's/^max_execution_time = .*/max_execution_time = 600/' /usr/local/etc/php/php.ini && \
    sed -i 's/^max_input_time = .*/max_input_time = 600/' /usr/local/etc/php/php.ini && \
    sed -i 's/^memory_limit = .*/memory_limit = 512M/' /usr/local/etc/php/php.ini && \
    sed -i 's/^upload_max_filesize = .*/upload_max_filesize = 512M/' /usr/local/etc/php/php.ini && \
    sed -i 's/^post_max_size = .*/post_max_size = 512M/' /usr/local/etc/php/php.ini && \
    echo "start strip and clean" && \
    strip --strip-all /usr/local/bin/php /usr/local/sbin/php-fpm && \
    find /usr/local/lib/php/extensions -name '*.so' -exec strip --strip-all {} \; && \
    rm -rf /usr/local/include/php /usr/local/lib/php/build \
        /usr/local/lib/php/doc /usr/local/lib/php/test \
        /usr/local/lib/php/.registry /usr/local/lib/php/.channels \
        /usr/local/lib/php/.depdb /usr/local/lib/php/.depdblock \
        /usr/local/lib/php/.filemap /usr/local/lib/php/.lock \
        /usr/local/lib/php/PEAR /usr/local/lib/php/Archive /usr/local/lib/php/OS \
        /usr/local/lib/php/System.php /usr/local/lib/php/peclcmd.php /usr/local/lib/php/pearcmd.php \
        /usr/local/bin/pecl /usr/local/bin/pear /usr/local/bin/phpize /usr/local/bin/php-config \
        /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini-production /tmp/pear

# ---------- 运行阶段：只保留运行时依赖和编译产物 ----------
FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/docker-base:focal

ENV LANG=en_US.UTF-8 \
    LANGUAGE=en_US.UTF-8 \
    LC_ALL=C.UTF-8

RUN echo "start install runtime deps" && \
    echo 'Acquire::Retries "5";' > /etc/apt/apt.conf.d/80-retries && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
        nginx memcached supervisor cron procps locales ca-certificates curl gnupg \
        libxml2 libsqlite3-0 libcurl4 libonig5 libzip5 \
        libpng16-16 libjpeg-turbo8 libfreetype6 \
        libbz2-1.0 libssl1.1 libreadline8 libcrypt1 \
        libsodium23 libxslt1.1 gettext-base libffi7 \
        libmagickwand-6.q16-6 libmemcached11 libssh2-1 zlib1g && \
    echo "start install sqlsrv driver" && \
    curl -sSL https://packages.microsoft.com/config/ubuntu/20.04/prod.list | tee /etc/apt/sources.list.d/microsoft-prod.list && \
    curl -sSL https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
    apt-get update && \
    apt-get install --allow-downgrades -y libodbc1=2.3.7 unixodbc=2.3.7 odbcinst1debian2=2.3.7 odbcinst=2.3.7 && \
    ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=builder /usr/local /usr/local

RUN echo "start config runtime" && \
    locale-gen en_US.UTF-8 zh_CN.UTF-8 && \
    mkdir -p /run/php /app/public && \
    echo "<?php phpinfo();" > /app/public/index.php && \
    chown www-data:www-data -R /app /run/php && \
    /usr/bin/ln -sf /usr/local/sbin/php-fpm /usr/sbin/php-fpm && \
    sed -i '/keepalive_timeout/ckeepalive_timeout 600;' /etc/nginx/nginx.conf && \
    for ext in pdo_sqlsrv redis imagick memcache memcached ssh2 \
               swoole igbinary sodium xsl gettext ffi readline; do \
        /usr/local/bin/php -m | grep -qi "^${ext}$" || { echo "missing ${ext}"; exit 1; }; \
    done && \
    odbcinst -q -d | grep -i 'ODBC Driver 17'

ENV PATH="/opt/mssql-tools/bin:${PATH}"

ADD supervisord-phpfpm.conf /etc/supervisor/conf.d/supervisord-phpfpm.conf
ADD nginx-default /etc/nginx/sites-available/default

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
