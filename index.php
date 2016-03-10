<?php

include 'System.php';

Bang\Lib\Request::GetGet($route = new Bang\MVC\Route());
try {
    $route->invoke();
} catch (Exception $ex) {
    Bang\MVC\DbContext::Rollback();
    Bang\MVC\DbContext::Disconnect();
    header('Content-Type: application/json');
    $result = new Bang\Lib\TaskResult();
    $result->SetUnsuccess($ex->getMessage(), $ex->getCode());

    $json_str = json_encode($result);
    if (ApiConfig::LogResponse) {
        $log = \Models\Current\Current::GetLogger();
        $log->response = $json_str;
        $log->error_code = $result->Value;
        $log->Insert();
    }
    echo $json_str;
}