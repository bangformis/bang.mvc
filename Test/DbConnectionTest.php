<?php

require_once 'TestSystem.php';

class DbConnectionTest extends PHPUnit_Framework_TestCase {

    public function testConnection() {
        // Arrange 測試若連線失敗或測試錯誤
        $conn = DbContext::GetConnection();
        
    }


}
