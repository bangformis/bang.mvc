<?php

require_once 'auto_load.php';
use Bang\Lib\Pagination;

class PaginationTest extends PHPUnit_Framework_TestCase {

    protected function setUp() {
        
    }

    public function testHasNextPage() {
        // Arrange
        $test1 = new Pagination(101, 2, 10);
        $test2 = new Pagination(10, 1, 100);

        // Act
        $true = $test1->HasNextPage();
        $false = $test2->HasNextPage();
        
        // Assert
        $this->assertEquals(TRUE, $true);
        $this->assertEquals(FALSE, $false);
    }
    
    public function testSkipCount() {
        // Arrange
        $test1 = new Pagination(101, 2, 10);
        $test2 = new Pagination(10, 1, 100);
        $test3 = new Pagination(101, 5, 20);
        
        // Act
        $_10 = $test1->GetSkipCount();
        $_0 = $test2->GetSkipCount();
        $_80 = $test3->GetSkipCount();
        
        // Assert
        $this->assertEquals(10, $_10);
        $this->assertEquals(0, $_0);
        $this->assertEquals(80, $_80);
    }

    
    
}
