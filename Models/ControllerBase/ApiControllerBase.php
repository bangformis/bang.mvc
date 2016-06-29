<?php

namespace Models\ControllerBase;

use Models\Current;

/**
 * @author Bang
 */
class ApiControllerBase extends \Bang\MVC\ControllerBase {

    function __construct() {
        if (\ApiConfig::LogRequest || \ApiConfig::LogResponse) {
            $log = Current\Current::GetLogger();
            $route = \Bang\MVC\Route::Current();
            $action = "{$route->controller}/{$route->action}";
            $request = http_build_query($_GET);
            $time = Current\Request::GetDatetime();
            $log->InitRequest($action, $request, $time);
            
            if (\ApiConfig::LogRequest) {
                $log->Insert();
            }
        }
    }

    /**
     * 以 Json 字串回傳json格式
     * @param string $json_str 傳入JSON格式字串，為空時將自動傳TaskResult並IsSuccess為true
     */
    protected function JsonContent($json_str) {
        if (\ApiConfig::LogResponse) {
            $log = \Models\Current\Current::GetLogger();
            $log->response = $json_str;
            $log->Insert();
        }
        parent::JsonContent($json_str);
    }

}
