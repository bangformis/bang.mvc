<?php

require_once '../Bang/lib/Appstore.php';

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
        Appstore::Add("GG", "test_name");
    }

    public function testGetAndContains() {
        // Arrange
        $test = new _forAppstoreTest();
        $test->name = "test1";
        $test->password = "gg9944";
        $test->roles = [1, 3, 4, 5];

        // Act
        Appstore::add($test);

        // Assert
        $true = Appstore::Contains("_forAppstoreTest");
        $test2 = Appstore::Get("_forAppstoreTest");

        $this->assertTrue($true);
        $this->assertEquals($test2, $test);
    }

    public function testRemove() {
        // Arrange

        $true = Appstore::Contains("test_name");
        $this->assertTrue($true);

        // Act
        Appstore::Remove("test_name");

        // Assert
        $false = Appstore::Contains("test_name");

        $this->assertFalse($false);
    }

}
