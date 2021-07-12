<?php namespace System\Persistance;

use System\Persistance\DBRepositeryInterface;

class DBRepositery implements DBRepositeryInterface {	
	
    private $connection = null;

    protected $dbconfig = DEFAULT_DB;
	
    public function __construct()
    {
        try {
            $this->connection =  ( new DBConnection($this->dbconfig) )->getConnection();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());   
        }			
    }
    
    // Insert a row/s in a Database Table
    public function Insert( $statement = "" , $parameters = [] )
    {
        try {
            $this->executeStatement( $statement , $parameters );
            return $this->connection->lastInsertId(); 
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());   
        }		
    }

    // Select a row/s in a Database Table
    public function SelectRow( $statement = "" , $parameters = [] )
    {
        try {
            $stmt = $this->executeStatement( $statement , $parameters );
            return $stmt->fetch();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());   
        }		
    }

    // Select a row/s in a Database Table
    public function Select( $statement = "" , $parameters = [] )
    {
        try {
            $stmt = $this->executeStatement( $statement , $parameters );
            return $stmt->fetchAll();
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());   
        }		
    }
    
    // Update a row/s in a Database Table
    public function Update( $statement = "" , $parameters = [] )
    {
        try {
            return $this->executeStatement( $statement , $parameters );
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());   
        }		
    }		
    
    // Remove a row/s in a Database Table
    public function Remove( $statement = "" , $parameters = [] )
    {
        try {
            $this->executeStatement( $statement , $parameters );
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());   
        }		
    }		
    
    // execute statement
    protected function executeStatement( $statement = "" , $parameters = [] )
    {
        try {
            $stmt = $this->connection->prepare($statement);
            $stmt->execute($parameters);
            return $stmt;
        } catch(\Exception $e) {
            throw new \Exception($e->getMessage());   
        }		
    }
		
}