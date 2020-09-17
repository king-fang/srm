### Consul 集群


![Laravel](https://cdn.learnku.com/uploads/images/202008/31/30430/r8MWWMMShC.png!large)


### nginx 


![Laravel](https://cdn.learnku.com/uploads/images/202008/31/30430/16b7BTMuts.png!large)

### 商品服务

![Laravel](https://cdn.learnku.com/uploads/images/202008/31/30430/1T4pKfK9GT.png!large)


### 测试

商品服务：http://106.54.7.136:81/goods/list

consul ui： http://106.54.7.136:8540/


### haproxy && keepalied
在 services/haproxy 目录下执行 docker build -t haproxy .  生成镜像
先写好haproxy 配置文件，开启容器
进入到haproxy 容器 开启 keepalied
keepalied -c /keepalied/keepalied.conf

然后执行如下，下面到ip是当前网络段里面段ip
ifconfig eth0:0 173.200.7.100 netmask 255.255.255.0 up

