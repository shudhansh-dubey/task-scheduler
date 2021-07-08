<?php

// Autoload all dependencies
require __DIR__.'/../vendor/autoload.php';

// Schedule Repostery Instance
$scheduleRepositery = new App\Repositeries\ScheduleRepositery;

// Schedule Repostery Instance
$weatherRepositery = new App\Repositeries\WeatherRepositery;