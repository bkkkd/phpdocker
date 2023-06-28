WP=`cd $(dirname $0);pwd`
BOXNAME=dockerbase
docker stop $BOXNAME
docker rm $BOXNAME
docker run \
        --hostname $BOXNAME\
        -v $WP/share:/share \
        --name $BOXNAME \
        --rm -it registry.cn-hangzhou.aliyuncs.com/bkkkd/docker-base:focal bash
