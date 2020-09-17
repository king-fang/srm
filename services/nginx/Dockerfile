FROM centos:centos7
RUN  mkdir /data  && mkdir /conf
RUN  groupadd -r nginx && useradd -r -g nginx nginx
#修改时区
RUN cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime && echo 'Asia/Shanghai' >/etc/timezone
ARG  PHP_VERSION=7.2
#添加centos源(先下载wget)
COPY epel-7.repo  /etc/yum.repos.d/epel.repo
#COPY

#RUN wget -O /etc/yum.repos.d/epel.repo   http://mirrors.aliyun.com/repo/Centos-7.repo
RUN yum update -y \
    && yum clean all  \
    && yum makecache  \
    && yum -y install  gcc gcc-c++ autoconf automake make zlib zlib-devel net-tools openssl* pcre* wget \
    && yum clean all  && rm -rf /var/cache/yum/*

#声明匿名卷
VOLUME /data

COPY nginx-1.14.1.tar.gz  /data/nginx-1.14.1.tar.gz

RUN cd /data \
    # 安装lua
#    && wget http://luajit.org/download/LuaJIT-2.0.5.tar.gz \
#    && tar -zxvf LuaJIT-2.0.5.gz && cd LuaJIT-2.0.5 && make && make install PREFIX=/usr/local/LuaJIT \
#    && export LUAJIT_LIB=/usr/local/lib && export LUAJIT_INC=/usr/local/include/luajit-2.0.5 \
    # 安装lua nginx模块
#    && wget https://github.com/simpl/ngx_devel_kit/archive/v0.2.19.tar.gz \
#    && wget https://github.com/openresty/lua-nginx-module/archive/v0.10.13.tar.gz \
    && tar -zxvf nginx-1.14.1.tar.gz \
    && cd nginx-1.14.1 \
    && wget https://github.com/weibocom/nginx-upsync-module/archive/v2.1.0.tar.gz \
    && tar -zxvf v2.1.0.tar.gz \
    && ./configure --prefix=/usr/local/nginx --user=nginx --group=nginx \
    --with-pcre --add-module=nginx-upsync-module-2.1.0 \
    --with-http_stub_status_module --with-http_ssl_module \
    --with-stream --with-stream_ssl_module \
    --error-log-path=/var/log/nginx/error.log \
    --http-log-path=/var/log/nginx/access.log \
    --pid-path=/var/run/nginx.pid \
    --lock-path=/var/run/nginx.lock \
    --with-stream_ssl_preread_module --with-stream_realip_module --with-http_slice_module \
    --with-mail --with-mail_ssl_module --with-compat --with-file-aio --with-http_v2_module \
    && make && make install && rm -rf /data/nginx-1.14.1.tar.gz

#全局使用nginx,软链接
RUN ln -s /usr/local/nginx/sbin/* /usr/local/sbin

#进入容器时默认打开的目录
WORKDIR /conf

#声明端口
EXPOSE 80 81

#执行一条指
ENTRYPOINT ["/usr/local/nginx/sbin/nginx","-c","/conf/nginx.conf","-g","daemon off;"]
