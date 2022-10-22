<?php
namespace system;

use app\Model\User;
use Database\Connection;
use system\Request;
class Auth{

    public function __construct()
    {
        $this->password=md5('12345');
        $this->login='admin';

    }

    public static function is_user(){
           return $_SESSION['auth']?? false;
    }
    public static function user():array{
            $user=new User();
          return  $user->find($_SESSION['auth']);
    }
/// переделать на запрос через модель с использованием конструктора
    public function login(Request $request){
        $user=new User();
        $resul=$user->selector()->where('name=:name',['name'=>$request->body->login])->get();
        if($request->body->login===$resul[0]['name'] && md5($request->body->password)===$resul[0]['password']){
            $_SESSION['auth']=$resul[0]['id'];
           return true;
        }
        return false;
    }
    public static function logout(){
       unset($_SESSION['auth']);
    }
}