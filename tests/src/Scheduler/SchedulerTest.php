<?php 

require __DIR__.'/../../../bootstrap/application.php';

use System\Scheduler\Scheduler;

class SchedulerTest {

    public function getResponse($command) 
    {  
        $scheduler = new Scheduler;
        return $scheduler->runCommand($command);

    }
}

$parser->getResponse("C:\xampp\php\php.exe C:\xampp\htdocs\projects\task-scheduler\tasks\weatherDataFetcher.php");