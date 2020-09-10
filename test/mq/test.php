<?php

require './vendor/autoload.php';


use PhpAmqpLib\Connection\AMQPStreamConnection;

use PhpAmqpLib\Message\AMQPMessage;

$con = new AMQPStreamConnection('127.0.0.1', 5603, 'admin', 'password');

var_dump($con);

$re = $con->channel();

var_dump($re);