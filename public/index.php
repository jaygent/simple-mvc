<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
spl_autoload_register(function($name){
    $path = dirname(__FILE__,2).'/'.str_replace('\\', '/', $name) . '.php';
    if(file_exists($path)){
        include_once($path);
    }
});
(new \system\Crfs());
use Router\Api;
use Router\Web;
function runurl(){
    $url=parse_url($_SERVER['REQUEST_URI']);
    $path=explode('/',ltrim($url['path'],'/'));
    if($path[0]==='api') { Api::paths();
    } else{
        Web::paths();
    }
}
runurl();
