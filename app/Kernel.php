<?php
namespace app;

class Kernel
{

    public static $middleware = [
    "auth"=>\app\middleware\AuthMiddleware::class
    ];


    public static $middlewareGroups = [
        'web' => [
            \app\middleware\CrfsTokenMiddleware::class,
        ],

        'api' => [
        ],
    ];

}