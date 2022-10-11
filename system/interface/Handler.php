<?php
namespace system\interface;

use system\Request;

interface Handler{

    public function handle(Request $request):bool;

}