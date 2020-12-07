<?php
require_once 'Api.php';
require_once 'Driver.php';

class DriverApi extends Api
{
    public $apiName = 'drivers';

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/drivers
     * @return string
     */
    public function indexAction()
    {
        $drivers = Driver::select_all();
        if($drivers){
            return $this->response($drivers, 200);
        }
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/drivers/1
     * @return string
     */
    public function viewAction()
    {
        $did = array_shift($this->requestUri);

        if($did){
            $drivers = Driver::select_by_id($did);
            if($drivers){
                return $this->response($drivers, 200);
            }
        }
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/drivers + параметры запроса name, email
     * @return string
     */
    public function createAction()
    {
        $id_driver = $this->requestParams['id_driver'];
        $name = $this->requestParams['name'];
        $surname = $this->requestParams['surname'];
        $father_name = $this->requestParams['father_name'];
        $telephone_number = $this->requestParams['telephone_number'];
        $sometext = $this->requestParams['sometext'];
        if($id_driver && $name && $surname && $father_name && $telephone_number && $sometext){
            $driver = new Driver([
                'id_driver' => $id_driver,
                'name' => $name,
                'surname' => $surname,
                'father_name' => $father_name,
                'telephone_number' => $telephone_number,
                'sometext' => $sometext
            ]);
            if($driver = $driver->create()){
                return $this->response('Driver created.', 200);
            }
        }
        return $this->response("Create error", 500);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/cars/1 + параметры запроса name, email
     * @return string
     */
    public function updateAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'];

        if(!$userId || !Users::getById($db, $userId)){
            return $this->response("User with id=$userId not found", 404);
        }

        $name = $this->requestParams['name'];
        $email = $this->requestParams['email'];

        if($name && $email){
            if($user = Users::update($db, $userId, $name, $email)){
                return $this->response('Data updated.', 200);
            }
        }
        return $this->response("Update error", 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/cars/1
     * @return string
     */
    public function deleteAction()
    {
        $parse_url = parse_url($this->requestUri[0]);
        $userId = $parse_url['path'];

        if(!$userId || !Users::getById($db, $userId)){
            return $this->response("User with id=$userId not found", 404);
        }
        if(Users::deleteById($db, $userId)){
            return $this->response('Data deleted.', 200);
        }
        return $this->response("Delete error", 500);
    }

}
?>