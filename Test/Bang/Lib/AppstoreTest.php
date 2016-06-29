<?php

require_once 'auto_load.php';

use Bang\Lib\Appstore;

/**
 * 應用程式單例存放測試
 */
class _forAppstoreTest {

    public $name;
    public $password;
    public $roles;

}

class AppstoreTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        Appstore::Set("test_name", "GG");
    }

    public function testGetAndSet() {
        // Arrange
        $test = new _forAppstoreTest();
        $test->name = "test1";
        $test->password = "gg9944";
        $test->roles = [1, 3, 4, 5];

        // Act
        Appstore::Set('_forAppstoreTest', $test);

        // Assert
        $test2 = Appstore::Get("_forAppstoreTest");

        $this->assertEquals($test2, $test);
    }

    public function testDelete() {
        // Arrange
        $true = Appstore::Get("test_name", FALSE);
        $this->assertTrue($true != FALSE);

        // Act
        Appstore::Delete("test_name");

        // Assert
        $false = Appstore::Get("test_name", FALSE);
        $this->assertFalse($false);
    }

}
