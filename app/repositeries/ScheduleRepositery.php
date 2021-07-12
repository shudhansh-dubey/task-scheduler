<?php namespace App\Repositeries;

use System\Persistance\DBRepositery;

class ScheduleRepositery extends DBRepositery {

    protected $table = 'schedules';

    public function findRandomEnabledTask() 
    {
        $sql  = "SELECT * FROM $this->table WHERE `enabled` = :enabled ORDER BY `schedule_id` DESC LIMIT 1";
        $params['enabled'] = 1;
        
        return $this->SelectRow($sql, $params);
    }

    public function findAllEnabledTasks() 
    {
        $sql  = "SELECT * FROM $this->table WHERE enabled = :enabled ";
        $params['enabled'] = 1;
        
        return $this->Select($sql, $params);
    }

    public function triggerTask($data) 
    {   
        $set = '';
        foreach ($data as $col => $val) {
            $set .= $col . '= :' . $col . ', '; 
            $params[$col] = $val;
        }
        $sql  = "UPDATE $this->table SET $set WHERE enabled = :enabled ";
        $params['enabled'] = 1;
        
        return $this->Select($sql, $params);
    }

    public function updateTaskStatus($data, $conds) 
    {   
        $set = '';
        foreach ($data as $col => $val) {
            $set .= $col . ' = :' . $col . ', '; 
            $params[$col] = $val;
        }
        $set = rtrim($set, ", ");

        $cond = '';
        foreach ($conds as $c => $v){
            $cond .= $c . ' = :' . $c . ' AND '; 
            $params[$c] = $v;
        }
        $cond = rtrim ($cond, " AND ");

        $sql  = "UPDATE $this->table SET $set WHERE $cond ";
        
        return $this->Update($sql, $params);
    }
}