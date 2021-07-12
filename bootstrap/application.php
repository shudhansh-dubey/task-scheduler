<?php

// Autoload all dependencies
require __DIR__.'/../vendor/autoload.php';

$scheduler = new System\Scheduler\Scheduler;

// Schedule Repostery Instance
$scheduleRepositery = new App\Repositeries\ScheduleRepositery;

// Schedule Repostery Instance
$weatherRepositery = new App\Repositeries\WeatherRepositery;

$cronlogRepositery = new App\Repositeries\CronLogRepositery;