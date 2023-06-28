FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/docker-base:focal

RUN echo "start install python3.11 pip nginx"&& \
    add-apt-repository -y ppa:deadsnakes/ppa && \
    apt install -y python3.11 python3.11-distutils nginx libmariadb-dev \
        build-essential libncursesw5-dev libssl-dev libsqlite3-dev tk-dev \
        libgdbm-dev libc6-dev libbz2-dev libffi-dev zlib1g-dev python3.11-dev && \
    update-alternatives --install /usr/bin/python3 python3 /usr/bin/python3.11 1 && \
    update-alternatives --install /usr/bin/python python /usr/bin/python3.11 1 && \
    curl -sS https://bootstrap.pypa.io/get-pip.py | python &&\
    pip install poetry && \
    curl -fsSL https://deb.nodesource.com/setup_18.x | bash - &&\
    apt install -y nodejs && \
    apt-get -y full-upgrade &&\
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* &&\
    mkdir -p /app/public && \
    echo "test page" >/app/public/index.html && \
    chown www-data:www-data -R /app 
    
  
ADD supervisord-nginx.conf /etc/supervisor/conf.d/supervisord-nginx.conf
ADD nginx-default /etc/nginx/sites-available/default

WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
