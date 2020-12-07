<?php
require_once('../config/smsclient.class.php');
require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');

/*
Sending SMS to client
Using https://alphasms.com service
*/

$u_api = $_POST['api_key'];

$mysql = (new Database())->connect();
$mysql->set_charset("utf8");
$user = $mysql->query("SELECT * FROM users WHERE api_key = '".$u_api."'");
$u = $user->fetch_all(MYSQLI_ASSOC);

$alpha_name = $_POST['alpha_name'];				// Alpha name (name that will be display as a sender in SMS)
$phone = $_POST['phone'];					// Phone where SMS will be sent
$rn = $_POST['registration_number'];	// Text to display in SMS
$template = $_POST['template'];	// Text to display in SMS

//init class with your login/password
//var_dump($u);
$sms = new SMSclient($u[0]['sms-login'], $u[0]['sms-pass'], $u[0]['sms-api-key']);

//sending SMS
$id = $sms->sendSMS($alpha_name, $phone, $template);

if($sms->hasErrors()) {
  http_response_code(500);
	die(var_dump($sms->getErrors()));
} else {
  http_response_code(200);
	echo('СМС надіслано');
}
