<?php
include_once ('../system/dev.php');
include_once ('../vendor/autoload.php');
spl_autoload_register(function ($name) {
        $path = dirname(__FILE__, 2) . '/' . str_replace('\\', '/', $name) . '.php';
        if (file_exists($path)) {
            include_once($path);
        }
    });
    use Router\Web;
    use system\Session;

try{
    // доделать момент сохранение сессий в дб или еще где
    Session::getInstance()->start();
    \system\Crfs::start();
    $container = new DI\Container();
    $rote=$container->get('Router\Web');
    $rote->paths();

}
catch(\Exceptions\Excurl $e){
    echo $e->getMessage();
}
catch (\Exceptions\ExcFatal $e){
    echo $e->getMessage();
}
