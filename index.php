<?php

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
    if (ApiConfig::LogResponse) {
        $log = \Models\Current\Current::GetLogger();
        $log->response = $json_str;
        $log->error_code = $result->Value;
        $log->Insert();
    }
    echo $json_str;
}