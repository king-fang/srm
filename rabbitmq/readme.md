### 启动Rabbitmq后，进入容器，设置 hosts和hostname 文件，将 *mq*目录下的文件 复制到 /etc/hosts下 

### 然后在 从 服务器里面运行


```
rabbitmqctl stop_app  关闭rabbitmq
rabbitmqctl reset  重新设置rabbitmq
rabbitmqctl join_cluster --ram rabbit@mq3   加入指定的 主节点 当作内存rabbitmq，其中 rabbit@mq3 是变量
rabbitmqctl start_app 启动 当前 rabbitmq
```