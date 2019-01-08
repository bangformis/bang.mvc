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

    public function EndWithResponse($is_success, $response) {
        $this->log->response = $response;
        $this->log->error_code = $is_success;
        $this->log->Update();
    }

    public function Error(Exception $ex) {
        $this->log->response = $ex->getMessage() . ":\n" . $ex->getTraceAsString();
        $this->log->error_code = $ex->getCode();
        $this->log->Update();
    }

    public function InitRequest($uri, $request) {
        $this->log = new api_logs();
        $this->log->InitRequest($uri, $request);
        $this->log->Insert();
    }

}
