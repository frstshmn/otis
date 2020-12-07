<?php

/**
  * Метод POST 
  * Просмотр отдельной записи (по id)
  */
$entered_email = $_GET['email'];
$entered_password = md5($_GET['password']);

require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');

$mysql = (new Database())->connect();

$mysql->store_result();

$password = $mysql->query("SELECT password FROM users WHERE email = '".$entered_email."'");

if($entered_password == $password->fetch_assoc()["password"])
{
	session_start();

	$uid = $mysql->query("SELECT id_client FROM users WHERE email = '".$entered_email."'") or die($mysql->error);

	$_SESSION['uid'] = $uid->fetch_assoc()["id_client"];

	$api_key = $mysql->query("UPDATE `users` SET `api_key` = '".md5($entered_email.time())."' WHERE id_client = ".$_SESSION['uid']) or die($mysql->error);
	http_response_code(200);
}
else
{
	http_response_code(401);
}
?>