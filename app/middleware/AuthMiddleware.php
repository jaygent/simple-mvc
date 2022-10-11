<?php
namespace app\middleware;

use system\Auth;
use system\interface\Handler;
use system\Request;

class AuthMiddleware implements Handler
{
    public function handle(Request $request):bool
    {
       if(Auth::is_user()){
           return true;
       }
       return false;
    }
}