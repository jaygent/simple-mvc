<?php
namespace Router;
use app\Controller\web\AuthController;
use app\Kernel;
use system\Auth;
use system\interface\iRoute;
use Core\Router;

class Web implements iRoute {
   public static function paths():void
   {
       $route=new Router(Kernel::$middlewareGroups['web']);
       $route->get('/',[\app\Controller\web\PostController::class,'index']);
       $route->get('/home',[\app\Controller\web\PostController::class,'home'],['auth']);
       $route->post('/login',[AuthController::class,'auth']);
       $route->get('/login',[AuthController::class,'index']);
       $route->get('/reg',[AuthController::class,'reg']);
       $route->post('/reg',[AuthController::class,'regpost']);
       $route->get('/logout',[AuthController::class,'logout']);
       $route->run();
   }
}