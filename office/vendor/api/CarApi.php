<?php
require_once 'Api.php';
require_once 'Car.php';

class CarApi extends Api
{
    public $apiName = 'cars';

    public function indexAction()
    {
        $cars = Car::select_all();
        if($cars){
            return $this->response($cars, 200);
        }
    }

    public function viewAction()
    {
        //id должен быть первым параметром после /user/x
        $registration_number = array_shift($this->requestUri);

        if($registration_number){
            $car = Car::select_by_RN($registration_number);
            if($car){
                return $this->response($car, 200);
            }
        }
    }

    public function createAction()
    {
        
        $brand = strtoupper($this->requestParams['brand']);
        $model = strtoupper($this->requestParams['model']);
        $type = $this->requestParams['type'];

        if(!empty($brand) && !empty($model) && !empty($type) && empty($this->requestParams['id_model'])){
            $mysql = (new Database())->connect();
            $mysql->set_charset("utf8");
            $mysql->query("INSERT INTO `brand_model` (`id_model`, `brand`, `model`, `type`) VALUES (NULL, '".$brand."', '".$model."', '".$type."');", MYSQLI_USE_RESULT);
            $brand_model = $mysql->query("SELECT * FROM brand_model WHERE brand = '".$brand."' AND model = '".$model."'", MYSQLI_USE_RESULT);
            $mid = $brand_model->fetch_all(MYSQLI_NUM);
            $model_id = $mid[0][0];
        }
        else{
            $model_id = $this->requestParams['id_model'];
        }

        $registration_number = strtoupper($this->requestParams['registration_number']);
        $driver_id = 1;//$this->requestParams['driver_id'];
        $firm_id = $this->requestParams['id_firm'];
        $vin_code = strtoupper($this->requestParams['vin_code']);
        $passing_date = $this->requestParams['date_of_passing'];
        $next_passing_date = $this->requestParams['next_passing_date'];
        $next_sertification_date = $this->requestParams['next_sertification_date'];
        $sertification_date = $this->requestParams['date_of_receiving_sertificate'];
        $is_sertified = $this->requestParams['availability_sertificate'];
        $note = NULL;//$this->requestParams['note'];
        $car = new Car($registration_number, $driver_id, $firm_id, $model_id, $vin_code, $passing_date, $next_passing_date, $sertification_date, $next_sertification_date, $is_sertified, $note);
        if($car = $car->create()){
            if($car == 200) {
              return $this->response("Машина створена", 200);
            } else {
              return $this->response("Помилка при створенні машини", 500);
            }
        }
        
        return $this->response("Сталась помилка", 500);
    }

    public function updateAction()
    {
        parse_str(file_get_contents("php://input"), $put_vars);
        $brand = strtoupper($put_vars['brand']);
        $model = strtoupper($put_vars['model']);
        $type = $put_vars['type'];

        if(!empty($brand) && !empty($model) && !empty($type) && empty($put_vars['id_model'])){
            $mysql = (new Database())->connect();
            $mysql->set_charset("utf8");
            $mysql->query("INSERT INTO `brand_model` (`id_model`, `brand`, `model`, `type`) VALUES (NULL, '".$brand."', '".$model."', '".$type."');", MYSQLI_USE_RESULT);
            $brand_model = $mysql->query("SELECT * FROM brand_model WHERE brand = '".$brand."' AND model = '".$model."'", MYSQLI_USE_RESULT);
            $mid = $brand_model->fetch_all(MYSQLI_NUM);
            $model_id = $mid[0][0];
        }
        else{
            $model_id = $put_vars['id_model'];
        }

        $id_firm = $put_vars['id_firm'];
        $prev_rn = strtoupper($put_vars['prev_rn']);
        $next_rn = strtoupper($put_vars['next_rn']);
        $vin_code = strtoupper($put_vars['vin_code']);
        $next_passing_date = $put_vars['next_passing_date'];
        $next_sertification_date = $put_vars['next_sertification_date'];
        $passing_date = $put_vars['date_of_passing'];
        $sertification_date = $put_vars['date_of_receiving_sertificate'];
        $car = Car::update($id_firm, $prev_rn, $next_rn, $vin_code, $model_id, $next_passing_date, $next_sertification_date, $passing_date, $sertification_date);
        if ($car == 200) {
          return $this->response('Інформація змінена', 200);
        } else {
          return $this->response("Сталась помилка", 500);
        }
    }

    public function deleteAction()
    {
        parse_str(file_get_contents("php://input"), $delete_vars);
        $registration_number = $delete_vars['registration_number'];
        $car = Car::delete($registration_number);
        if ($car == 200) {
          return $this->response('Машина видалена', 200);
        } else {
          return $this->response("Сталась помилка", 500);
        }
    }

}
//897c8fde25c5cc5270cda61425eed3c8
?>