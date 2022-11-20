<?php
namespace Core;
use system\Auth;
use system\Request;
use Twig\Environment;

class Controller{

    protected View $views;

    public function __construct()
    {
        $this->views=new View();
    }
}