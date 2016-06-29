<?php

require_once 'auto_load.php';

use Bang\Lib\Checker;

/**
 * 字串功能測試
 */
class CheckerTest extends PHPUnit_Framework_TestCase {

    public function testIsEmail() {
        //Arrange 
        $email = 'bangtest@gmail.com';

        //Act
        $result = Checker::IsEmail($email);

        //Assert
        $this->assertTrue($result);
    }

}
