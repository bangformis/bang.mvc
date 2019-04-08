<?php

namespace Models\ControllerBase;

use ApiConfig;
use Bang\Lib\eString;
use Bang\MVC\ControllerBase;
use Bang\MVC\Route;
use Models\Current\Current;
use Models\Current\Request;

/**
 * @author Bang
 */
class ApiControllerBase extends ControllerBase {

    private static $start_mtime;

    function __construct() {
        if (ApiConfig::LogRequest || ApiConfig::LogResponse || ApiConfig::LogError) {
            self::$start_mtime = microtime(1);
            $log = Current::GetLogger();
            $route = Route::Current();
            $action = "{$route->controller}/{$route->action}";
            $request = http_build_query($_GET);
            $time = Request::GetLibDatetime();
            $log->InitRequest($action, $request, $time);

            if (ApiConfig::LogRequest) {
                $log->Insert();
            }
        }
    }

    /**
     * �Json 字串�傳json��
     * @param string $json_str �入JSON��字串，為空�將自�傳TaskResult並IsSuccess�true
     */
    protected function JsonContent($json_str) {
        if (ApiConfig::LogResponse || ApiConfig::LogError) {
            $end_mtime = microtime(1);
            $start_mtime = self::$start_mtime;
            $span_mtime = round($end_mtime - $start_mtime, 4);
            $log = Current::GetLogger();
            $log->response = $json_str;
            $log->span_ms = $span_mtime;
            if (ApiConfig::LogResponse) {
                if (ApiConfig::LogRequest) {
                    $log->Update();
                } else {
                    $log->Insert();
                }
            }
            if (ApiConfig::LogError && eString::StartsWith($json_str, '{"IsSuccess":false')) {
                $log->action = "Error:" . $log->action;
                $log->Insert();
            }
        }
        parent::JsonContent($json_str);
    }

}
