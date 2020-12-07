<?php
  require_once("/home/inco/otis.co.ua/office/vendor/config/database.php");
  
	$mysql = (new Database())->connect();
	$mysql->set_charset("utf8");
	$brands = $mysql->query("SELECT DISTINCT brand FROM brand_model", MYSQLI_USE_RESULT);
  echo(json_encode($brands->fetch_all(MYSQLI_ASSOC)));
?>