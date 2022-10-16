<?php

namespace app\Controller\web;

use system\Auth;
use system\Crfs;
use system\Request;

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

}