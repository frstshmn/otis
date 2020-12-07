<?php
	require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');
	class Firm{
		public $id_firm;
		public $name;
		public $telephone;
		public $email;

		public function __construct($id_firm,$name,$telephone,$email) {
	        $this->id_firm = $id_firm;
	        $this->name = $name;
	        $this->telephone = $telephone;
	        $this->email = $email;
	    }

		public function select_all(){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");

			$id = $mysql->query("SELECT id_client FROM users WHERE api_key = '".$u_api."'");
			$uid = $id->fetch_assoc()['id_client'];

			$firm = $mysql->query("SELECT * FROM firm WHERE id_client = '".$uid."'", MYSQLI_USE_RESULT);
			return $firm->fetch_all(MYSQLI_ASSOC);
		}

		public function select_by_id($fid){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");

			$id = $mysql->query("SELECT id_client FROM users WHERE api_key = '".$u_api."'");
			$uid = $id->fetch_assoc()['id_client'];

			$firm = $mysql->query("SELECT * FROM firm WHERE id_client = '".$uid."' AND id_firm = '".$fid."'", MYSQLI_USE_RESULT);
			return $firm->fetch_all(MYSQLI_ASSOC);
		}

		public function create(){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");

			$id = $mysql->query("SELECT id_client FROM users WHERE api_key = '".$u_api."'");
			$uid = $id->fetch_assoc()['id_client'];

			if($firm = $mysql->query("INSERT INTO `firm` (`id_firm`, `id_client`, `name`, `telephone`, `email`) VALUES ('".$this->id_firm."','".$uid."','".$this->name."','".$this->telephone."','".$this->email."');", MYSQLI_USE_RESULT))
			{
				return 200;
			}
			else{
				return 500;
			}
		}

		public function update($id_firm_prev, $id_firm_next, $name, $telephone, $email){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			if($firm = $mysql->query("UPDATE firm SET id_firm = '".$id_firm_next."', name = '".$name."', telephone = '+".trim($telephone)."', email = '".$email."' WHERE id_firm = '".$id_firm_prev."'", MYSQLI_USE_RESULT)){
				return 200;
			}
			else{
				return 500;
			}
		}

		public function delete($rn){
			$mysql = (new Database())->connect();
			//$car = $mysql->query("DELETE cars.registration_number,cars.id_driver,cars.id_firm,cars.id_model,cars.vin_code,cars.date_of_passing,cars.date_of_receiving_sertificate,cars.availability_sertificate,cars.sometext FROM cars INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client WHERE users.id_client = '".$uid."'", MYSQLI_USE_RESULT);
		}
	}
?>