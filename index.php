<?php

use Bang\Lib\Request;
use Bang\Lib\TaskResult;
use Bang\MVC\DbContext;
use Bang\MVC\Route;

include 'System.php';

Request::GetGet($route = new Route());
try {
    $route->invoke();
} catch (Exception $ex) {
    DbContext::Rollback();
    DbContext::Disconnect();
    header('Content-Type: application/json');
    $result = new TaskResult();
    $result->SetUnsuccess($ex->getMessage(), $ex->getCode());
    $json_str = json_encode($result);
    echo $json_str;
}