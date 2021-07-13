<?php

/**
 * Database Configuration
 */

// Default DB Configuration
define( "DEFAULT_DB" , [
    
    // Username of database
    'user'=>'root',

    // Password for database
    'password' => '',

    // Address of server host
    'host' => 'localhost',

    // Name of database
    'dbname' => 'task_scheduler',
    
    // Preferred driver
    // PDO_MYSQL is default driver
    'driver' =>  'pdo_mysql'
]);