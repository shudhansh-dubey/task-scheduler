<?php namespace App\Repositeries;

use System\Persistance\DBRepositery;

class WeatherRepositery extends DBRepositery {

    protected $table = 'weather';

    public function addRecord(array $data) 
    {
        if (!empty($data)) {
            $sql = "insert into $this->table ";
            $params = [];

            foreach ($data as $col => $val) {
                $sql .= $col . '= :' . $col . ', '; 
                $params[$col] = $val;
            }

            return $this->Insert(rtrim($sql, ", "), $params);
        }
    }
}