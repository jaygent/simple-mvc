<?php

namespace app\Controller\web;

use system\Auth;
use system\Crfs;
use system\Request;
use Database\Connection as db;

class AuthController extends \Core\Controller
{
    public function index(){
        if(!empty($_SESSION['auth'])){
            header('Location: /home');
        }
        $this->views->render('login.twig',['crfs'=>Crfs::crfs()]);
    }
    public function auth(Request $request){
        $auth=new Auth();
        if($auth->login($request)); header('Location: /home');
    }
    public function logout(){
       Auth::logout();
        header('Location: /');
    }
    public function reg(){
        $this->views->render('reg.twig',['crfs'=>Crfs::crfs()]);
    }
    public function regpost(Request $request){

        $db=db::getInstance();
        $params=[
            'name'=>$request->body->name,
            'password'=>md5($request->body->password),
        ];
        $db->query('INSERT INTO user (name,password)  VALUE (:name,:password)',$params);
        $_SESSION['auth']=$db->lastInsertId();
        header('Location: /home');
    }
}