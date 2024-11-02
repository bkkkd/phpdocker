FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/phpdocker:php8

RUN echo "start install lua5.1"&& \
    apt update &&\
    apt-get -y install lua5.1 liblua5.1-0-dev && \
    pecl install LuaSandbox && \
    echo "extension=luasandbox.so" > /etc/php/8.1/mods-available/luasandbox.ini  && \
    /usr/bin/ln -sf /etc/php/8.1/mods-available/luasandbox.ini /etc/php/8.1/cli/conf.d/25-luasandbox.ini && \
    /usr/bin/ln -sf /etc/php/8.1/mods-available/luasandbox.ini /etc/php/8.1/fpm/conf.d/25-luasandbox.ini &&\

    apt-get -y full-upgrade &&\
    apt-get clean
    
  

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
