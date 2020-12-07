<?php
require_once 'Api.php';
require_once 'Firm.php';

class FirmApi extends Api
{
    public $apiName = 'firms';

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/firm
     * @return string
     */
    public function indexAction()
    {
        $firms = Firm::select_all();
        if($firms){
            return $this->response($firms, 200);
        }
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/firm/1
     * @return string
     */
    public function viewAction()
    {
        //id должен быть первым параметром после /firm/x
        $fid = array_shift($this->requestUri);

        if($fid){
            $firm = Firm::select_by_id($fid);
            if($firm){
                return $this->response($firm, 200);
            }
        }
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/cars + параметры запроса name, email
     * @return string
     */
    public function createAction()
    {
        $id_firm = $this->requestParams['id_firm'];
        $name = $this->requestParams['name'];
        $telephone = $this->requestParams['telephone'];
        $email = $this->requestParams['email'];
        $firm = new Firm($id_firm, $name, $telephone, $email);
        if($firm = $firm->create()){
            if($firm == 200) {
              return $this->response("Фірма створена", 200);
            } else {
              return $this->response("Сталась помилка, можливо даний ЄДРПОУ вже існує", 500);
            }
        }
        
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/cars/1 + параметры запроса name, email
     * @return string
     */
    public function updateAction()
    {   
        parse_str(file_get_contents("php://input"), $put_vars);
        $id_firm_next = $put_vars['id_firm_next'];
        $id_firm_prev = $put_vars['id_firm_prev'];
        $name = $put_vars['name'];
        $telephone = $put_vars['telephone'];
        $email = $put_vars['email'];
        $firm = Firm::update($id_firm_prev, $id_firm_next, $name, $telephone, $email);
        if($firm == 200) {
          return $this->response("Дані змінені", 200);
        } else {
          return $this->response("Сталась помилка, можливо даний ЄДРПОУ вже існує", 500);
        }
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