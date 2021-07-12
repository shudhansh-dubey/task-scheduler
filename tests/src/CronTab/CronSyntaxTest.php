<?php

require __DIR__.'/../../../bootstrap/application.php';

use App\Repositeries\ScheduleRepositery;
use System\CronTab\CronSyntaxFormat; 

class CronSyntaxTest {

    public function assertSyntax($syntax, $schedule) 
    {
        $tsyntax = CronSyntaxFormat::encode($schedule);
        return $tsyntax == $syntax;
    }
}

$scheduleRepositery = new ScheduleRepositery();
$schedule = $scheduleRepositery->findRandomEnabledTask();
$parser = new CronSyntaxTest();
var_dump($parser->assertSyntax("*/3 * * * * ", $schedule));