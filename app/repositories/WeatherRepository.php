<?php namespace App\Repositories;

use System\Persistance\DBRepository;

class WeatherRepository extends DBRepository {

    protected $table = 'weather';

    public function addRecord(array $data) 
    {
        if (!empty($data)) {
            
            $cols = ''; $values = ''; $params = [];
            foreach ($data as $col => $val) {
                $cols .=  $col . ' , '; 
                $values .= "'" . $val  . "'"  . ' , ';
                $params[$col] = $val;
            }
            $cols = rtrim($cols, " , ");
            $values = rtrim($values, " , ");

            $sql  = "INSERT INTO $this->table ( $cols ) VALUES ( $values ) ";

            return $this->Insert(rtrim($sql, ", "), $params);
        }
    }

    public function getLastRecord() 
    {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";
        $params = [];
        return $this->Select($sql, $params);
    }
}