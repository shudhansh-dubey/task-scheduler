<?php namespace System\Persistance;

interface DBRepositeryInterface {

    public function Insert( $statement = "" , $parameters = [] ); 

    // Select a row/s in a Database Table
    public function Select( $statement = "" , $parameters = [] ); 
    
    // Update a row/s in a Database Table
    public function Update( $statement = "" , $parameters = [] ); 		
    
    // Remove a row/s in a Database Table
    public function Remove( $statement = "" , $parameters = [] ); 
}