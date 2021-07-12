<?php

// Autoload all dependencies
require __DIR__.'/../vendor/autoload.php';

// Scheduler Component
$scheduler = new System\Scheduler\Scheduler;

// Schedule Repostery Instance
$scheduleRepositery = new App\Repositeries\ScheduleRepositery;

// Schedule Repostery Instance
$weatherRepositery = new App\Repositeries\WeatherRepositery;

// Cron Log Repositery
$cronlogRepositery = new App\Repositeries\CronLogRepositery;