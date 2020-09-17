1. 先运行 docker build -t redis5 .

2. 运行docker-composer up -d

3. 进入任意一台容器运行
redis-cli --cluster create 192.21.2.200:6379 192.21.2.201:6379 192.21.2.202:6379 192.21.2.203:6379 192.21.2.204:6379 192.21.2.205:6379 --cluster-replicas 1