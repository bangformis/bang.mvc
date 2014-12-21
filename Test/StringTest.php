<?php

require_once '../Bang/lib/String.php';

/**
 * 字串功能測試
 */
class StringTest extends PHPUnit_Framework_TestCase {

    public function testRemoveSuffix() {
        // Arrange
        $suffix = 'Controller';
        $str1 = 'HomeController';
        $str2 = 'Home2Controller';
        $str3 = 'SiteController';

        // Act
        $result1 = String::RemoveSuffix($str1, $suffix);
        $result2 = String::RemoveSuffix($str2, $suffix);
        $result3 = String::RemoveSuffix($str3, $suffix);

        // Assert
        $this->assertEquals($result1, "Home");
        $this->assertEquals($result2, "Home2");
        $this->assertEquals($result3, "Site");
    }

    public function testRemovePrefix() {
        // Arrange
        $prefix = 'bla_';
        $str = 'bla_string_bla_bla_bla';

        // Act
        $result = String::RemovePrefix($str, $prefix);

        // Assert
        $this->assertEquals($result, "string_bla_bla_bla");
    }

    public function testStartsWith() {
        // Arrange
        $test = "test1";

        // Act
        $isTrue = String::StartsWith($test, "test");
        $isFlase = String::StartsWith($test, "1");

        // Assert
        $this->assertTrue($isTrue);
        $this->assertFalse($isFlase);
    }

    public function testEndsWith() {
        // Arrange
        $test = "test1";

        // Act
        $isFlase = String::EndsWith($test, "test");
        $isTrue = String::EndsWith($test, "1");

        // Assert
        $this->assertTrue($isTrue);
        $this->assertFalse($isFlase);
    }

}
