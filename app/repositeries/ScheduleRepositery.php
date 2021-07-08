<?php namespace App\Repositeries;

use System\Persistance\DBRepositery;

class ScheduleRepositery extends DBRepositery {

    protected $table = 'schedules';

    public function findAllAvailableTasks() 
    {
        $sql  = "select 
                 schedule_id
                 from $this->table
                 where is_processed = :is_processed
                 ";

        $params['is_processed'] = 'N';
        
        $result = $this->Select($sql, $params);
    }
}