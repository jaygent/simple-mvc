<?php
namespace Router;

use app\Kernel;
use system\interface\iRoute;
use Core\Router;

class Api implements iRoute{
    public static function paths():void
    {
        $route=new Router(Kernel::$middlewareGroups['api']);
        $route->get('/',[\app\Controller\web\PostController::class,'index'],['auth']);

        $route->run();
    }

}
