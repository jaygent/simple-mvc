<?php
namespace system;
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

    public static function user(){
        if(self::is_user()){
            $json=fopen(dirname(__FILE__, 2) . '/session.json','r+');
            $contentjsom=stream_get_contents($json);
        }
    }

    public function login(Request $request){
        if($request->body->login===$this->login && md5($request->body->password)===$this->password){
            $_SESSION['auth']=true;
            echo 'ok';
        }
    }
    public function logout(){
       unset($_SESSION['auth']);
       echo 'logout';
    }
}