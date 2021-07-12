<?php namespace App\Repositeries;

use System\Persistance\DBRepositery;

class CronLogRepositery extends DBRepositery {

    protected $table = 'cron_logs';

    public function insertCronLog($data)
    {
        $cols = ''; $values = ''; $params = [];
        foreach ($data as $col => $val) {
            $cols .=  $col . ' , '; 
            $values .= "'" . $val  . "'"  . ' , ';
            $params[$col] = $val;
        }
        $cols = rtrim($cols, " , ");
        $values = rtrim($values, " , ");

        $sql  = "INSERT INTO $this->table ( $cols ) VALUES ( $values ) ";
        
        return $this->Insert($sql, $params);
    }

}