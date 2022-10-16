<?php
namespace app\Controller\web;

use Core\Controller;
use app\Model\Post;
use system\Auth;

class PostController extends Controller{

    public function index(){
  return $this->views->render('post.twig',['title'=>'index','text'=>session_id()]);
    }

    public function home(){
        //var_dump(Auth::user());
        return $this->views->render('home.twig',['title'=>'Home','user'=>Auth::user()]);
    }
}