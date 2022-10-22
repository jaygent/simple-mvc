<?php
namespace Core;

use Twig\Environment;

class View {
 protected Environment $twig;

 public function __construct()
 {
     $loader = new \Twig\Loader\FilesystemLoader(dirname(__FILE__, 2).'/views');
     $this->twig = new \Twig\Environment($loader, [
         'cache'=>false,
         //'cache' => dirname(__FILE__, 2).'/cache',
     ]);
 }

 public function render(string $templname,array $arg){
     echo $this->twig->render($templname,$arg);
 }

}