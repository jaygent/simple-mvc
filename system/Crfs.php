<?php

namespace system;

class Crfs
{
    public static function start():void{
        if(empty($_SESSION['crfs'])) $_SESSION['crfs']=self::createToken();
    }

    public static function createToken():string{
       return hash('sha256',random_bytes(32));
   }

   public static function crfs():string{
        return "<input type='hidden' name='crfs' value='{$_SESSION['crfs']}'/>";
   }

}