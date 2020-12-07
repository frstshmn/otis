<?php
	require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');
	class Driver{
		public $id_driver;
		public $name;
		public $surname;
		public $father_name;
		public $telephone_number;
		public $sometext;

		public function __construct($id_driver,$name,$surname,$father_name,$telephone_number,$sometext) {
	        $this->id_driver = $id_driver;
	        $this->name = $name;
	        $this->surname = $surname;
	        $this->father_name = $father_name;
	        $this->telephone_number = $telephone_number;
	        $this->sometext = $sometext;
	    }

		public function select_all(){
			session_start();
			if(!$_SESSION['uid']){
				echo("Please, login");
			}
			$uid = $_SESSION['uid'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$car = $mysql->query("SELECT drivers.* FROM drivers INNER JOIN cars ON drivers.id_driver = cars.id_driver INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client WHERE users.id_client = '".$uid."'", MYSQLI_USE_RESULT);
			return $car->fetch_all(MYSQLI_ASSOC);
		}

		public function select_by_id($did){
			session_start();
			if(!$_SESSION['uid']){
				echo("Please, login");
			}
			$uid = $_SESSION['uid'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$car = $mysql->query("SELECT drivers.* FROM drivers INNER JOIN cars ON drivers.id_driver = cars.id_driver INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client WHERE users.id_client = '".$uid."' AND drivers.id_driver = '".$did."'", MYSQLI_USE_RESULT);
			return $car->fetch_assoc(MYSQLI_ASSOC);
		}

		public function create(){
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$car = $mysql->query("INSERT INTO `drivers` (`id_driver`, `name`, `surname`, `father_name`, `telephone_number`, `sometext`) VALUES (NULL, '".$this->id_driver."','".$this->name."','".$this->surname."','".$this->father_name."','".$this->telephone_number."','".$this->sometext."');", MYSQLI_USE_RESULT);
			return 'Completed';
		}

		public function update($rn, $registration_number, $driver_id, $firm_id, $model_id, $vin_code, $passing_date, $sertification_date, $is_sertified, $note){
			$mysql = (new Database())->connect();
			$car = $mysql->query("SELECT * FROM cars WHERE = '".$entered_email."'", MYSQLI_USE_RESULT);
		}

		public function delete($rn){
			$mysql = (new Database())->connect();
			$car = $mysql->query("DELETE cars.registration_number,cars.id_driver,cars.id_firm,cars.id_model,cars.vin_code,cars.date_of_passing,cars.date_of_receiving_sertificate,cars.availability_sertificate,cars.sometext FROM cars INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client WHERE users.id_client = '".$uid."'", MYSQLI_USE_RESULT);
		}
	}
?>