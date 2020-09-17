FROM alpine:latest

RUN sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories \
    && apk add  gcc g++ libc-dev  wget vim  openssl-dev make linux-headers net-tools \
    && rm -rf /var/cache/apk/*

COPY redis-5.0.1.tar.gz redis-5.0.1.tar.gz

RUN mkdir -p /usr/src/redis \
      && mkdir -p /redis/data \
      && mkdir -p /redis/conf \
      && mkdir -p /redis/log   \
      && mkdir -p /var/log/redis \
      && tar -zxvf redis-5.0.1.tar.gz -C /usr/src/redis \
      && rm -rf redis-5.0.1.tar.gz \
      && cd /usr/src/redis/redis-5.0.1 && make \
      && cd /usr/src/redis/redis-5.0.1 && make install

EXPOSE 6379

#CMD ["redis-server", "/usr/src/redis/redis-5.0.7/redis.conf"]

# 主
#docker run -itd --name redis-master-10 --network=redis --ip=192.21.2.10 -v /root/redis/redis/master:/redis -p 6380:6379  redis5

# 从1
#w --network=redis --ip=192.21.2.20 -v /root/redis/redis/slave1:/redis -p  6381:6379 redis5

# 从2
#docker run -itd --name redis-slave-30 --network=redis --ip=192.21.2.30 -v /root/redis/redis/slave2:/redis -p 6382:6379 redis5
