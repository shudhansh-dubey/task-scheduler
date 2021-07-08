<?php namespace System\Persistance;

class DBConnection {

    private $conn;

    public function __construct($dbconfig)
    {   
        $dsn = "mysql:host=".$dbconfig['host'].";dbname=".$dbconfig['dbname'].";";
        $connection = new \PDO($dsn, $dbconfig['user'], $dbconfig['password']);
       
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        
        $this->conn = $connection;
    }

    public function getConnection() 
    {
        return $this->conn;
    }
}