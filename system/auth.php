<?php
namespace system;

use app\Model\User;
use system\Request;
class Auth{
    protected $password;
    public $login;
    public $id=1;

    public function __construct()
    {
        $this->password=md5('12345');
        $this->login='admin';

    }

    public static function is_user(){
           return $_SESSION['auth']?? false;
    }
/// должно быть создание модели на основе айди юзера
    public static function user():array{
            $user=new User();
          return  $user->find($_SESSION['auth']);
    }

    public function login(Request $request):bool{



        if($request->body->login===$this->login && md5($request->body->password)===$this->password){
            $_SESSION['auth']=$this->id;
           return true;
        }
        return false;
    }
    public static function logout(){
       unset($_SESSION['auth']);
       echo 'logout';
    }
}