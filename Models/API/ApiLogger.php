<?php

namespace Models\API;

use Bang\Abstracts\IApiLogger;
use Exception;
use Models\Database\MonthlyTables\api_logs;

/**
 * @author Bang
 */
class ApiLogger implements IApiLogger {

    /**
     * @var api_logs 
     */
    private $log;
    private $start_mtime;

    public function EndWithResponse($is_success, $response) {
        $this->log->response = $response;
        $this->log->error_code = $is_success;
        $end_mtime = microtime(1);
        $start_mtime = $this->start_mtime;
        $span_mtime = round($end_mtime - $start_mtime, 4);
        $this->log->span_ms = $span_mtime;
        $this->log->Update();
    }

    public function Error(Exception $ex) {
        $this->log->response = $ex->getMessage() . ":\n" . $ex->getTraceAsString();
        $this->log->error_code = $ex->getCode();
        $this->log->Update();
    }

    public function InitRequest($uri, $request) {
        $this->start_mtime = microtime(1);
        $this->log = new api_logs();
        $this->log->InitRequest($uri, $request);
        $this->log->Insert();
    }

}
