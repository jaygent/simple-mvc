<?php
namespace Core;

use app\middleware\CrfsTokenMiddleware;
use Router\Api;
use Router\Web;
use system\Request;
use app\Kernel;

class Router{
    private array $rote;
    public Request $request;
    public array $middleware;
    public array $params;
    public array $param;

    public function __construct(array $middleware)
    {
        $this->middleware=$middleware;
        $this->request=new Request();
    }

    /**
     * @param string $route
     * @param mixed $params
     * @return void
     */
    public  function get( string $route, mixed $params, array $middleware=[]):void{
        $this->rote['GET'][$route]=[$params,$middleware];
    }

    /**
     * @param string $route
     * @param mixed $params
     * @return void
     */
    public  function post( string $route, mixed $params, array $middleware=[]):void{
        $this->rote['POST'][$route]=[$params,$middleware];
    }

    private function much():bool
    {
        if (is_array($this->rote[$_SERVER['REQUEST_METHOD']])) {
            foreach ($this->rote[$_SERVER['REQUEST_METHOD']] as $rout => $k) {
                $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $rout);
                $route = '#^' . $route . '$#';
                $url = explode('?', $_SERVER['REQUEST_URI']);
                $url = array_shift($url);
                $this->param=$k;
                if (preg_match($route, $url, $matches)) {
                    foreach ($matches as $key => $match) {
                        if (is_string($key)) {
                            if (is_numeric($match)) {
                                $match = (int)$match;
                            }
                            $this->params[$key] = $match;
                        }
                    }
                    return true;
                }
            }return false;
        }return false;
    }

    /**
     * @param string $route
     * @param mixed $param
     * @return void
     */
    public function run():void{
   if($this->much()){
        foreach ($this->param[1] as $m){
                $middleware[]=Kernel::$middleware[$m];
            }
            $middleware=array_merge($this->middleware,$middleware??[]);
            $param=$this->param[0];
            if(!$this->checkmiddleware($middleware)){
                echo '403';
                return;
            }
            if(is_callable($param)){
                call_user_func_array($param,$this->params);
            }elseif(is_array($param)){
                $class=$param[0];
                $action=$param[1];
                if (class_exists($class)) {
                    if (method_exists($class, $action)) {
                        $controller = new $class($params??[],$this->request);
                        $controller->$action($this->request);
                    }
                }
            }elseif(is_file("{$_SERVER['DOCUMENT_ROOT']}/$param")){
                require_once ("{$_SERVER['DOCUMENT_ROOT']}/$param");
            }
        }else{echo '404';}
      }

    public function checkmiddleware($middlware):bool{
        foreach($middlware as $m){
                if(!(new $m)->handle($this->request)){
                    return false;
                }
            }
        return true;
    }

}