<?php 

require __DIR__.'/../../../bootstrap/application.php';

use App\Repositeries\ScheduleRepositery;
use System\CronTab\CronSyntaxFormat;
use System\CronTab\CronTabParser;

class CronTabParserTest {

    public function assertParse($schedule) 
    {  
        foreach ($schedule as $s) {
            $timestamp = CronTabParser::parse($s);
            if (time() == $timestamp) {
                echo 'equal';
                echo date('Y-m-d h:i:s', $timestamp);
            }
            else if (time() > $timestamp) {
                echo 'passed';
                echo date('Y-m-d h:i:s', $timestamp);
            }
            else if (time() < $timestamp) {
                echo 'upcoming';
                echo date('Y-m-d h:i:s', $timestamp);
            }
        }
    }
}

$scheduleRepositery = new ScheduleRepositery();
$schedule = $scheduleRepositery->findAllEnabledTasks();
$parser = new CronTabParserTest();
$parser->assertParse($schedule);