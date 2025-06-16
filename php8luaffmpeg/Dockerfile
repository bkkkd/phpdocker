FROM registry.cn-hangzhou.aliyuncs.com/bkkkd/phpdocker:php8lua

RUN echo "start install ffmpeg"&& \
    apt --allow-releaseinfo-change update &&\
    apt-get -y install ffmpeg && \
    apt-get -y full-upgrade &&\
    apt-get clean



WORKDIR /app

VOLUME ["/app"]

EXPOSE 80

CMD ["/usr/bin/supervisord"]
