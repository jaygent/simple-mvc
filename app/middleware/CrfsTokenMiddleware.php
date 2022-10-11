<?php
namespace app\middleware;

use system\interface\Handler;
use system\Request;

class CrfsTokenMiddleware implements Handler
{
        public function handle(Request $request):bool
         {
          if($request->body->crfs===$_SESSION['crfs']){
          return true;
          }else{
              return false;
          }
        }
}