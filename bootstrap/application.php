<?php

// Autoload all dependencies
require __DIR__.'/../vendor/autoload.php';

// Scheduler Component
$scheduler = new System\Scheduler\Scheduler;

// Schedule Repostery Instance
$scheduleRepository = new App\Repositories\ScheduleRepository;

// Schedule Repostery Instance
$weatherRepository = new App\Repositories\WeatherRepository;

// Cron Log Repository
$cronlogRepository = new App\Repositories\CronLogRepository;