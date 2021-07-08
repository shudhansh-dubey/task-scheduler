<?php namespace App\CronTab;

use App\CronTab\CronTabInterface;

class CronTabManager implements CronTabInterface {

    function __construct($host=NULL, $port=NULL, $username=NULL, $password=NULL)
    {
        $path_length     = strrpos(__FILE__, "/");      
        $this->path      = substr(__FILE__, 0, $path_length) . '/';
        $this->handle    = 'crontab.txt';        
        $this->cron_file = "{$this->path}{$this->handle}";
    
        try
        {
            if (is_null($host) || is_null($port) || is_null($username) || is_null($password)) throw new Exception("Please specify the host, port, username and password!");
            
            $this->connection = @ssh2_connect($host, $port);
            if ( ! $this->connection) throw new Exception("The SSH2 connection could not be established.");
    
            $authentication = @ssh2_auth_password($this->connection, $username, $password);
            if ( ! $authentication) throw new Exception("Could not authenticate '{$username}' using password: '{$password}'.");
        }
        catch (Exception $e)
        {
            $this->error_message($e->getMessage());
        }
    }
    
    public function exec() 
    {
        
    }
}