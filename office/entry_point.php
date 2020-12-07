<?php

require_once 'vendor/api/CarApi.php';
require_once 'vendor/api/FirmApi.php';
require_once 'vendor/api/DriverApi.php';
require_once 'vendor/api/UserApi.php';

	$uri = explode('/', trim($_SERVER['REQUEST_URI'],'/'));
	array_shift(array_shift($uri));
	$uri = explode('?', $uri[0]);
	if($uri[0] == "cars"){
		$api = new CarApi();
	}
	else if($uri[0] == "firms"){
		$api = new FirmApi();
	}
	else if($uri[0] == "drivers"){
		$api = new DriverApi();
	}
	else if($uri[0] == "users"){
		$api = new UserApi();
	}

    echo $api->run();
?>