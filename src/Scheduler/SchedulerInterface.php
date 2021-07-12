<?php namespace System\Scheduler;

interface SchedulerInterface {

    public function hasTasks(); 
    public function run();
}