<?php

namespace app\Model;

use system\Request;

class User extends \Core\Model
{
    public string $table='users';
    protected string $pk='id';

    public static function login(Request $request):int{
        return true;
    }
}