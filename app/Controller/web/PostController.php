<?php
namespace app\Controller\web;

use Core\Controller;
use app\Model\Post;

class PostController extends Controller{

    public function index(){
  return $this->views->render('post.twig',['title'=>'index','text'=>'text']);
    }
}