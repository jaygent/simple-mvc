<?php

namespace system;

class Request
{
    public \ArrayObject $body;
    public function __construct()
    {
        $body=array_merge($_REQUEST,$_COOKIE,json_decode(file_get_contents("php://input"),1)??[],getallheaders());
        $this->body=new \ArrayObject($body);
        $this->body->setFlags(\ArrayObject::ARRAY_AS_PROPS);
    }
}
