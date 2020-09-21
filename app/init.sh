#! /bin/sh

location=`ip addr | grep /24 | awk '{print $2}' | awk -F '/' '{print $1}'`

host="SRM_HOST"=$location
context=$host"\n"

# 这里有个小问题，当 -ip 和 p 一起时，定义的参数只展示 SRM_CONSUL_CHECK_PORT，-ip 改成不冲突的即可
while getopts "t:i:p:n:" opt; do
    case $opt in
        t)
            context=$context"SRM_CONSUL_CHECK_TYPE="$OPTARG"\n"
        ;;
        i)
            context=$context"SRM_CONSUL_CHECK_IP="$OPTARG"\n"
        ;;
        p)
            context=$context"SRM_CONSUL_CHECK_PORT="$OPTARG"\n"
        ;;
        n)
            context=$context"SRM_CONSUL_SERVER_NAME="$OPTARG"\n"
        ;;
    esac
done

echo -e $context > ./.env

