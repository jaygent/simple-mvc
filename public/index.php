<?php
include_once ('../system/dev.php');
include_once ('../vendor/autoload.php');
spl_autoload_register(function ($name) {
        $path = dirname(__FILE__, 2) . '/' . str_replace('\\', '/', $name) . '.php';
        if (file_exists($path)) {
            include_once($path);
        }
    });
    use Router\Api;
    use Router\Web;
    use system\Session;

try{
    Session::getInstance()->start();
    \system\Crfs::start();
    function runurl()
    {
        $url = parse_url($_SERVER['REQUEST_URI']);
        $path = explode('/', ltrim($url['path'], '/'));
        if ($path[0] === 'api') {
            Api::paths();
        } else {
            Web::paths();
        }
    }

    runurl();
}
catch(\Exceptions\Excurl $e){
    echo $e->getMessage();
}
catch (\Exceptions\ExcFatal $e){
    echo $e->getMessage();
}
