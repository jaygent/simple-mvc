<?php
namespace Core;
use system\Auth;
use system\Request;
use Twig\Environment;

class Controller{
    protected array $params;
    protected Request $request;
    protected View $views;

    public function __construct($params,$request)
    {
        $this->params=$params;
        $this->request=$request;
        $this->views=new View();
    }
}