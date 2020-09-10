<?php

require './vendor/autoload.php';


use PhpAmqpLib\Connection\AMQPStreamConnection;

use PhpAmqpLib\Message\AMQPMessage;

$con = new AMQPStreamConnection('127.0.0.1', 8103, 'admin', 'password');

var_dump($con);

$channel = $con->channel();

$channel->queue_declare('qos_queue', false, true, false, false);


var_dump($channel->basic_qos(null, 10, null));