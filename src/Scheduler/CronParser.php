<?php namespace System\Scheduler;

class CronParser {   

    public static function parse_crontab($time, $crontab)
    {
        $time = explode(' ', date('i G j n w', strtotime($time)));
        $crontab = explode(' ', $crontab);
        foreach ($crontab as $k => &$v) {
            $v = explode(',', $v);
            foreach ($v as &$v1) {
                $v1 = preg_replace(array('/^\*$/', '/^\d+$/', '/^(\d+)\-(\d+)$/', '/^\*\/(\d+)$/'),
                    array(
                        'true', 
                        '"'.$time[$k].'"==="\0"', 
                        '(\1<='.$time[$k].' and '.$time[$k].'<=\2)', 
                        $time[$k].'%\1===0'
                    ),
                    $v1
                );
            }
            $v = '('.implode(' or ', $v).')';
        }

        $crontab = implode(' and ', $crontab);
        return eval('return '.$crontab.';');
    }
}