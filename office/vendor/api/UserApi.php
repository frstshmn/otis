<?php
require_once 'Api.php';
require_once 'User.php';

class UserApi extends Api
{
    public $apiName = 'users';

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/user
     * @return string
     */
    public function indexAction()
    {
        $users = User::select_all();
        if($users){
            return $this->response($users, 200);
        }
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/user/1
     * @return string
     */
    public function viewAction()
    {
        //id должен быть первым параметром после /user/x
        $id = array_shift($this->requestUri);

        if($id == 'apikeys'){
            $api_key = User::get_api_key();
            return $this->response($api_key, 200);
        }

        if($id){
            $user = User::select_by_id($id);
            if($user){
                return $this->response($user, 200);
            }
        }
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/user + параметры запроса name, email
     * @return string
     */
    public function createAction()
    {
        $first_name = $this->requestParams['first_name'];
        $second_name = $this->requestParams['second_name'];
        $date_birthday = $this->requestParams['birthdate'];
        $telephone = $this->requestParams['telephone'];
        $password = $this->requestParams['password'];
        $email = $this->requestParams['email'];
        $api_key = $this->requestParams['api_key'];
            $user = new User($first_name,$second_name,$telephone,$email,$date_birthday,$password,$api_key);
            if($user = $user->create()){
                return $this->response('User created.', 200);
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
        $sms = array_shift($this->requestUri);
        if ($sms == "sms") {
            //return 'v1tsk';
            parse_str(file_get_contents("php://input"), $put_vars);
            $user = User::change_sms($put_vars['sms_login'], $put_vars['sms_pass'], $put_vars['sms_api_key'], $put_vars['sms_alpha_name'], $put_vars['sms_text_template']);
            if($user == 200) {
              return $this->response("Налаштування SMS-розсилки змінено", 200);
            } else {
              return $this->response("Помилка у виконанні операції", 500);
            }
        }

        parse_str(file_get_contents("php://input"), $put_vars);
        
        if(!empty($put_vars['name']) && !empty($put_vars['surname']) && !empty($put_vars['email']) && !empty($put_vars['birthday']) && !empty($put_vars['phone']))
        {
            $first_name = $put_vars['name'];
            $second_name = $put_vars['surname'];
            $date_birthday = $put_vars['birthday'];
            $telephone = $put_vars['phone'];
            $email = $put_vars['email'];
            $department = $put_vars['department'];
            $street = $put_vars['street'];
            $web_site = $put_vars['web_site'];
            $user = User::update($first_name, $second_name, $date_birthday, $telephone, $email, $department, $street, $web_site);

            if ($user == 200) {
              return $this->response("Інформацію про користувача змінено", 200);
            } else {
              return $this->response("Сталась помилка", 500);
            }
        }

        else if(!empty($put_vars['password']) && !empty($put_vars['new']) && !empty($put_vars['repeat']))
        {
            $password = $put_vars['password'];
            $new = $put_vars['new'];
            $repeat = $put_vars['repeat'];
            $user = User::change_password($password,$new,$repeat);
            if ($user == 200) {
              return $this->response("Пароль було змінено", 200);
            } else {
              return $this->response("Сталась помилка, перевірте правильність введення", 500);
            }
        }
        
        return $this->response("Сталась помилка", 500);
        
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