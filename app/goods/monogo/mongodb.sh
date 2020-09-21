# ! /bin/sh
docker-compose --compatibility up -d

echo -e "sleep 20s start\n"

sleep 30s

echo -e "sleep 20s end \n"

docker exec -it mongo_config_174_20 bash -c "echo 'rs.initiate({_id: \"fates-mongo-config\",configsvr: true, members: [{ _id : 0, host : \"174.200.7.10:27019\" },{ _id : 1, host : \"174.200.7.20:27019\" }]})' | mongo --port 27019"

docker exec -it mongos_shard_A_174_2 bash -c "echo 'rs.initiate({_id: \"shard_A\",members: [{ _id : 10, host : \"174.200.7.2:27018\" },{ _id : 11, host : \"174.200.7.3:27018\" },{ _id : 12, host : \"174.200.7.4:27018\", arbiterOnly: true }]})' | mongo --port 27018"

docker exec -it mongos_shard_B_174_6 bash -c "echo 'rs.initiate({_id: \"shard_B\",members: [{ _id : 10, host : \"174.200.7.6:27018\" },{ _id : 11, host : \"174.200.7.7:27018\" },{ _id : 12, host : \"174.200.7.8:27018\", arbiterOnly: true }]})' | mongo --port 27018"

docker exec -it mongos_route_174_200 bash -c "echo 'sh.addShard(\"shard_A/174.200.7.2:27018,174.200.7.3:27018,174.200.7.4:27018\")' | mongo"

docker exec -it mongos_route_174_200 bash -c "echo 'sh.addShard(\"shard_B/174.200.7.6:27018,174.200.7.7:27018,174.200.7.8:27018\")' | mongo"
