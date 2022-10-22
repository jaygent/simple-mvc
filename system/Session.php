<?php
 namespace system;
 use system\SessionFile;

 class Session
{
    public static $instance;
   public \SessionHandlerInterface $session;
    public function __construct()
    {
        session_set_save_handler(new SessionFile(), true);
    }

     public static function getInstance() : static{
         if(static::$instance === null){
             static::$instance = new static();
         }

         return static::$instance;
     }

    public function start(){
        session_start();
    }
}