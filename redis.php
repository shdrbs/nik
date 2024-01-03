<?php
	$redis_host = "127.0.0.1";
	$redis_port = 6379;

	$redis = new Redis();
	$redis->connect($redis_host, $redis_port, 1000);
?>