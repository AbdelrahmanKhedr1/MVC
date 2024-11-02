<?php

namespace Iliuminates\Logs;

class Log extends \Exception
{
    protected $log_file;
    public function __construct($message,$code=0,\Exception  $previous=null,$log_file = 'error.log')
    {
        parent::__construct($message,$code,$previous);
        $this->disblayErorr();
        $this->log_file = $log_file;
        $this->logErorr();
    }
    public function logErorr(){
        $logMessage = date('Y-m-d H:i:s')." - Error {$this->getMessage()} in {$this->getFile()} on line {$this->getLine()} \n";
        file_put_contents(storage_path('log/'.$this->log_file),$logMessage, FILE_APPEND);
    }
    public function disblayErorr()
    {
        $message = $this->getMessage();
        $line = $this->getLine();
        $file = $this->getFile();
        $trance = $this->getTraceAsString();
        include base_path('app/views/errors/exception.tpl.php');
    }
}
