<?php namespace System\Scheduler;

class CronSyntax {

    public static function encode($schedule) 
    {   
        $cron = '';
        if (! empty($schedule)) {
            $cron .= is_null($schedule['minute']) ? "* " : $schedule['minute'] . " " ;    
            $cron .= is_null($schedule['hour']) ? "* " : $schedule['hour'] . " " ;
            $cron .= is_null($schedule['day']) ? "* " : $schedule['day'] . " " ;
            $cron .= is_null($schedule['month']) ? "* " : $schedule['month'] . " " ;
            $cron .= is_null($schedule['weekday']) ? "* " : $schedule['weekday'] . " " ; 
        }
        return $cron;
    }
}