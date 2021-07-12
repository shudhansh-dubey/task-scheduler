<?php namespace System\Scheduler;

use System\Scheduler\SchedulerInterface;
use System\Scheduler\CronSyntax;
use System\Scheduler\CronParser;
use App\Repositeries\CronLogRepositery;
use App\Repositeries\ScheduleRepositery;

class Scheduler implements SchedulerInterface {

    protected $repositery;
    protected $cronLogRepositery;

    public function __construct()
    {
        $this->repositery = new ScheduleRepositery;
        $this->cronLogRepositery = new CronLogRepositery;
    }

    protected function hasSchedule ($task) 
    {
        $_cron_string = trim(CronSyntax::encode($task));
        $_after_timestamp = date('Y-m-d h:i:s'); 

        return CronParser::parse_crontab($_after_timestamp, $_cron_string);
    }

    protected function runCommand($command) 
    {
        // Execute the scheduler command
        $response = shell_exec($command);

        return json_decode(json_encode($response));
    }

    protected function getTasks () 
    {
        $enabled_tasks = $this->repositery->findAllEnabledTasks();
        $result = [];
        if (! empty($enabled_tasks)) {
            foreach ($enabled_tasks as $task) {
                if ( $this->hasSchedule($task) ) {
                    $result[] = $task;
                }
            }
        }
        return $result;
    }

    public function hasTasks ()
    {
        $enabled_tasks = $this->repositery->findAllEnabledTasks();
        $result = [];
        if (! empty($enabled_tasks)) {
            foreach ($enabled_tasks as $task) {
                if ( $this->hasSchedule($task) ) {
                    $result[] = $task;
                }
            }
        }
        return count($result) > 0;
    }

    public function run() 
    {   
        $response = ['success' => false, 'message' => '', 'data' => ''];
        $tasks = $this->getTasks();
        
        if (count($tasks) > 0) {
            foreach ($tasks as $task) {
                $task = (Object) $task;
                if (isset($task->command) && !empty($task->command)) {
    
                    // Run scheduled command
                    $resp = $this->runCommand($task->command);
                    if ($resp) {
                        if ( $resp['success'] ) {
                            $status = 2; $message = $resp['message'];
                        } else {
                            $status = 1; $message = $resp['message'];
                        }
                    } else {
                        $status = 1; $message = 'Something went wrong';
                    }
    
                    // Time for schedule
                    // Update status over schedule table
                    $time = date('Y-m-d h:i:s');
                    $data = [ 'last_triggered_at' => $time ];
                    $conds = [ 'schedule_id' => $task->schedule_id ];
                    if ($this->repositery->updateTaskStatus($data, $conds)) {
                        
                        // Add cron log entry
                        $cronData =[
                            'schedule_id' => $task->schedule_id,
                            'scheduled_at' => $time,
                            'message' => $message,
                            'completed_at' => date('Y-m-d h:i:s'),
                            'status' => $status
                        ];
                        $cronid = $this->cronlogRepositery->insertCronLog($cronData);
    
                        if ($cronid) {
                            $response['success'] = true;
                            $response['message'] = 'Cron log executed successfully';
                        } else {
                            $response['message'] = 'Cron record save failed';
                        }
                    } else {
                        $response['message'] = 'Failed to update status';
                    }
    
                } else {
                    $response['message'] = 'No command to execute';
                }
            }
        } 
        return $response;
    }
}