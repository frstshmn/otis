<?php
	require_once("/home/inco/otis.co.ua/office/vendor/config/database.php");

	$brand = $_GET['brand'];
	$model = $_GET['model'];

	$mysql = (new Database())->connect();
	$mysql->set_charset("utf8");

	if(!empty($brand)){
	 	$models = $mysql->query("SELECT * FROM brand_model WHERE brand = '".$brand."' ORDER BY brand ASC, model ASC", MYSQLI_USE_RESULT);
	 	echo(json_encode($models->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE));
	}
	else if(!empty($model)){
	 	$type = $mysql->query("SELECT type FROM brand_model WHERE id_model = '".$model."' ORDER BY brand ASC, model ASC", MYSQLI_USE_RESULT);
	 	echo(json_encode($type->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE));
	}
	else{
		$brands = $mysql->query("SELECT DISTINCT brand FROM brand_model ORDER BY brand ASC, model ASC", MYSQLI_USE_RESULT);
		echo(json_encode($brands->fetch_all(MYSQLI_ASSOC), JSON_UNESCAPED_UNICODE));
	}
?>