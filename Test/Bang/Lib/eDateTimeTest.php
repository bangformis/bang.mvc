<?php

use Bang\Lib\eDateTime;

require_once 'auto_load.php';

class eDateTimeTest extends PHPUnit_Framework_TestCase {

    public function testGetAndSet() {
        $hour = rand(10, 23);
        $minite = rand(10, 59);
        $second = rand(10, 59);
        $datetime_str = "2016-06-30 $hour:$minite:$second";
        $datetime = new eDateTime($datetime_str);

        $this->assertEquals('2016-06-30', $datetime->ToDateString());
        $this->assertEquals($datetime_str, $datetime->ToDateTimeString());
        
        $datetime->AddDay(1);
        $this->assertEquals('2016-07-01', $datetime->ToDateString());
        
        $datetime->AddDay(-1);
        $this->assertEquals('2016-06-30', $datetime->ToDateString());
        
        $datetime->AddMonth(1);
        $this->assertEquals('2016-07-30', $datetime->ToDateString());
        
        $datetime->AddDay(1);
        $this->assertEquals('2016-07-31', $datetime->ToDateString());
        
        $datetime->AddMonth(-1);
        $this->assertEquals('2016-07-01', $datetime->ToDateString());
    }

}
