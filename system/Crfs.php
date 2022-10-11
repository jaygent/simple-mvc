<?php

namespace system;

class Crfs
{
    public function __construct()
    {
        if(empty($_SESSION['crfs'])) $_SESSION['crfs']=self::createToken();
        if(empty($_COOKIE['crfs'])) setcookie('crfs',$_SESSION['crfs']);
    }

    public static function createToken():string{
       return hash('sha256',random_bytes(32));
   }

}