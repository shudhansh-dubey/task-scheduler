<?php

require __DIR__.'/../../../bootstrap/application.php';

use System\Scheduler\CronParser;

class CronParserTest {

    public function assertEquals($syntax, $resp) 
    {
        $parser = new CronParser;

        return $parser->parse_crontab(date('Y-m-d h:i:s'), $syntax) == $resp;
    }
}

$parser = new CronParserTest();
var_dump($parser->assertEquals("* * * * * ", true));