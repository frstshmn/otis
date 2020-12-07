<?php
	require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');
	require_once('/home/inco/otis.co.ua/office/vendor/config/smsclient.class.php');
	class User{
		public $first_name;
		public $second_name;
		public $date_birthday;
		public $password;
		public $telephone;
		public $email;
		public $api_key;

		public function __construct($first_name, $second_name, $telephone, $email, $date_birthday, $password, $api_key) {
	        $this->first_name = $first_name;
	        $this->second_name = $second_name;
	        $this->date_birthday = $date_birthday;
	        $this->telephone = $telephone;
	        $this->email = $email;
	        $this->password = $password;
	        $this->api_key = $api_key;
	    }

	    public function get_api_key(){
	    	session_start();
	    	if(!$_SESSION['uid']){
				return "Please, login";
			}
			$uid = $_SESSION['uid'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$user = $mysql->query("SELECT api_key FROM users WHERE id_client = '".$uid."'");
			return $user->fetch_assoc()['api_key'];
	    }

		public function select_all(){

			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];

			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");

			$user = $mysql->query("SELECT * FROM users WHERE api_key = '".$u_api."'");
			
			$u = $user->fetch_all(MYSQLI_ASSOC);

			$sms = new SMSclient($u[0]['sms-login'], $u[0]['sms-pass'], $u[0]['sms-api-key']);
			if($sms->hasErrors())
				$u[0]['balance'] = 'Немає даних';
			else
				$u[0]['balance'] = $sms->getBalance();

			return $u;

		}

		public function select_by_id($id){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$user = $mysql->query("SELECT * FROM users WHERE id_client = '".$uid."'");
			
			$u = $user->fetch_all(MYSQLI_ASSOC);

			$sms = new SMSclient($u[0]['sms-login'], $u[0]['sms-pass'], $u[0]['sms-api-key']);
			if($sms->hasErrors())
				$u[0]['balance'] = 'Немає даних';
			else
				$u[0]['balance'] = $sms->getBalance();

			return $u;
		}

		public function create(){
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$user = $mysql->query("INSERT INTO `users` (`id_client`, `login`, `email`, `password`, `telephone_number`, `group`, `first_name`, `second_name`, `date_birthday`, `api-key`) VALUES (NULL, '".$this->email."','".$this->email."','".md5(md5($this->password))."','".$this->telephone."','user','".$this->first_name."','".$this->second_name."','".$this->date_birthday."','".$this->api_key."');");
			return 'Користувач створений. Поверніться назад та авторизуйтесь';
		}

		public function update($first_name, $second_name, $date_birthday, $telephone, $email, $department, $street, $web_site){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			if($user = $mysql->query("UPDATE `users` SET `email` = '".$email."', `telephone_number` = '+".trim($telephone)."', `first_name` = '".$first_name."', `second_name` = '".$second_name."', `date_birthday` = '".$date_birthday."', `department` = '".$department."', `street` = '".$street."', `web_site` = '".$web_site."' WHERE api_key = '".$u_api."'")){

				return 200;
			}
			else{
				return $mysql->error;
			}
		}

		public function change_password($password, $new, $repeat){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$user = $mysql->query("SELECT * FROM users WHERE api_key = '".$u_api."'", MYSQLI_USE_RESULT);
			$upass = $user->fetch_all(MYSQLI_ASSOC);
			//$upass = json_decode($upass);
			if($new == $repeat && md5(md5($password)) == $upass[0]['password']){
        $user = $mysql->query("UPDATE `users` SET `password` = '".md5(md5($new))."' WHERE api_key = '".$u_api."'");
				return 200;
			}
			else{
				return 500;
			}
		}

		public function change_sms($sms_login, $sms_pass, $sms_api_key, $sms_alpha_name, $sms_text_template){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			if ($user = $mysql->query("UPDATE `users` SET `sms-login` = '".$sms_login."', `sms-pass` = '".$sms_pass."', `sms-api-key` = '".$sms_api_key."', `sms-alpha-name` = '".$sms_alpha_name."', `sms-text-template` = '".$sms_text_template."' WHERE api_key = '".$u_api."'"))
			{
				return 200;
			}
			else{
				return 500;
			}
		}

		public function delete($rn){
			$mysql = (new Database())->connect();
		}
	}
?>