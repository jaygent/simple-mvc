<?php
namespace Router;
use app\Kernel;
use system\Auth;
use system\interface\iRoute;
use Core\Router;

class Web implements iRoute {
   public static function paths():void
   {
       $route=new Router(Kernel::$middlewareGroups['web']);
       $route->get('/',[\app\Controller\web\PostController::class,'index']);
       $route->get('/home',[\app\Controller\web\PostController::class,'index'],['auth']);
       $route->post('/login',[Auth::class,'login']);
       $route->get('/logout',[Auth::class,'logout']);


       $route->run();
   }
}