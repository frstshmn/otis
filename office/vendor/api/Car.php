<?php
	require_once('/home/inco/otis.co.ua/office/vendor/config/database.php');
	class Car{
		public $registration_number;
		public $driver_id;
		public $firm_id;
		public $model_id;
		public $vin_code;
		public $passing_date;
		public $sertification_date;
		public $is_sertified;
		public $next_passing_date;
		public $next_sertification_date;		
		public $note;

		public function __construct($registration_number, $driver_id, $firm_id, $model_id, $vin_code, $passing_date, $next_passing_date, $sertification_date = NULL, $next_sertification_date = NULL, $is_sertified, $note) {
	        $this->registration_number = $registration_number;
	        $this->driver_id = $driver_id;
	        $this->firm_id = $firm_id;
	        $this->model_id = $model_id;
	        $this->vin_code = $vin_code;
	        $this->passing_date = $passing_date;
	        $this->next_passing_date = $next_passing_date;
	        $this->next_sertification_date = $next_sertification_date;
	        $this->sertification_date = $sertification_date;
	        $this->is_sertified = $is_sertified;
	        $this->note = $note;
	    }

		public function select_all(){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			if(!empty($_GET['count']) && $_GET['count'] == true){
				$car = $mysql->query("SELECT COUNT(cars.registration_number) AS count FROM cars INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client WHERE users.api_key = '".$u_api."'", MYSQLI_USE_RESULT);
				return $car->fetch_all(MYSQLI_ASSOC);
			}
			if(empty($_GET['page'])){
				$car = $mysql->query("SELECT cars.registration_number, cars.id_driver, firm.name, firm.telephone, cars.id_model, brand_model.brand, brand_model.model, cars.vin_code, cars.date_of_passing, cars.next_passing_date, cars.date_of_receiving_sertificate, cars.next_sertification_date, cars.availability_sertificate, cars.sometext FROM cars INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client INNER JOIN brand_model ON brand_model.id_model = cars.id_model WHERE users.api_key = '".$u_api."' ORDER BY cars.next_passing_date ASC, cars.date_of_receiving_sertificate ASC", MYSQLI_USE_RESULT);
				return $car->fetch_all(MYSQLI_ASSOC);
			}
			$page = $_GET['page']*50-50;
			$car = $mysql->query("SELECT cars.registration_number, cars.id_driver, firm.name, firm.telephone, cars.id_model, brand_model.brand, brand_model.model, cars.vin_code, cars.date_of_passing, cars.next_passing_date, cars.date_of_receiving_sertificate, cars.next_sertification_date, cars.availability_sertificate, cars.sometext FROM cars INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client INNER JOIN brand_model ON brand_model.id_model = cars.id_model WHERE users.api_key = '".$u_api."' ORDER BY cars.next_passing_date ASC, cars.date_of_receiving_sertificate ASC LIMIT ".$page.", 50", MYSQLI_USE_RESULT);
			return $car->fetch_all(MYSQLI_ASSOC);
		}

		public function select_by_RN($rn){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");
			$car = $mysql->query("SELECT cars.registration_number, cars.id_driver, firm.name, firm.telephone, cars.id_model, brand_model.brand, brand_model.model, cars.vin_code, cars.date_of_passing, cars.next_passing_date, cars.date_of_receiving_sertificate, cars.next_sertification_date, cars.availability_sertificate, cars.sometext FROM cars INNER JOIN firm ON cars.id_firm = firm.id_firm INNER JOIN users ON firm.id_client = users.id_client INNER JOIN brand_model ON brand_model.id_model = cars.id_model WHERE users.api_key = '".$u_api."' AND cars.registration_number = '".$rn."'", MYSQLI_USE_RESULT);
			return $car->fetch_all(MYSQLI_ASSOC);
		}

		public function create(){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			$mysql->set_charset("utf8");

			if($car = $mysql->query("INSERT INTO `cars` (`registration_number`, `id_driver`, `id_firm`, `id_model`, `vin_code`, `date_of_passing`, `next_passing_date`, `date_of_receiving_sertificate`, `next_sertification_date`, `availability_sertificate`, `sometext`) VALUES ('".$this->registration_number."','".$this->driver_id."','".$this->firm_id."','".$this->model_id."','".$this->vin_code."','".$this->passing_date."','".$this->next_passing_date."','".$this->sertification_date."','".$this->next_sertification_date."','".$this->is_sertified."','".$this->note."');", MYSQLI_USE_RESULT)){
				return 200;
			}
			else{
				return 500;
			}
			
		}

	

		public function update($id_firm, $prev_rn, $next_rn, $vin_code, $model_id, $next_passing_date, $next_sertification_date = NULL, $passing_date, $sertification_date){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			if($car = $mysql->query("UPDATE cars SET id_firm = '".$id_firm."', registration_number = '".$next_rn."', vin_code = '".$vin_code."', id_model = '".$model_id."', date_of_passing = '".$passing_date."', next_passing_date = '".$next_passing_date."', date_of_receiving_sertificate = '".$sertification_date."', next_sertification_date = '".$next_sertification_date."' WHERE registration_number = '".$prev_rn."'", MYSQLI_USE_RESULT))
			{
				return 200;
			}
			else{
				return 500;
			}
			
		}

		public function delete($rn){
			if(!$_GET['api_key']){
				return "Please, use your api key";
			}
			$u_api = $_GET['api_key'];
			$mysql = (new Database())->connect();
			if($car = $mysql->query("DELETE FROM cars WHERE registration_number = '".$rn."'", MYSQLI_USE_RESULT))
			{
				return 200;
			}
			else{
				return $mysql->error();
			}
		}
	}
?>