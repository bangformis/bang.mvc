<?php

require_once '../Bang/lib/Event.php';

/**
 * 事件功能測試
 */
class _forEventTest {

    public function __construct() {
        $this->increatment = 0;
    }

    public $increatment;

}

class EventTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        
    }

    public function testEvent() {
        // Arrange
        $test = new _forEventTest();

        // Act
        Event::RegisterCallback("testEvent", function($data) {
            $data->increatment++;
        });

        Event::Trigger("testEvent", $test);
        Event::Trigger("testEvent", $test);
        Event::Trigger("testEvent", $test);

        // Assert
        $this->assertEquals($test->increatment, 3);

        Event::Trigger("testEvent", $test);
        $this->assertEquals($test->increatment, 4);
    }

}
