<?php
namespace system;
use SessionHandlerInterface;
class SessionFile implements SessionHandlerInterface
{
    private $path;
    public $data;

   public function __construct()
   {
       if( $this->open(dirname(__FILE__, 2).'/session','')){
           session_save_path(dirname(__FILE__, 2).'/session');
       }
   }

    /**
     * @inheritDoc
     */
    public function close()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function destroy(string $id)
    {
        $filename = $this->path.'/sess_'.$id;
        if ( file_exists($filename) ) @unlink($filename);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function gc(int $max_lifetime)
    {
        // TODO: Implement gc() method.
    }

    /**
     * @inheritDoc
     */
    public function open(string $path, string $name)
    {
        $this->path = $path;
        if ( !is_dir($this->path) ) {
            mkdir($this->path, 0777);
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read(string $id)
    {
        $this->data = false;
        $filename = $this->path.'/sess_'.$id;
        if ( file_exists($filename) ) $this->data = file_get_contents($filename);
        if ( $this->data === false ) $this->data = '';
        return $this->data;
    }

    /**
     * @inheritDoc
     */
    public function write(string $id, string $data)
    {
        $filename = $this->path.'/sess_'.$id;
        if ( $data !== $this->data ) {

            return file_put_contents($filename, $data) === false ? false : true;
        }
        else return touch($filename);
    }
}