<?php
namespace app\middleware;

use system\interface\Handler;
use system\Request;

class CrfsTokenMiddleware implements Handler
{
        public function handle(Request $request):bool
         {
             if($_SERVER['REQUEST_METHOD']=="POST" || $_SERVER['REQUEST_METHOD']==="PUT"){
                 return $request->body->crfs===$_SESSION['crfs'] ? true : false;
             }
             return true;
        }
}