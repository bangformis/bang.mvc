<?php

namespace Models\Database\MonthlyTables;

use Bang\Lib\eString;
use Bang\MVC\DbContext;
use Bang\MVC\Route;
use DateTime;

/**
 * @author Bang
 */
class api_logs {

    function __construct() {
        $this->error_code = 0;
    }

    
    public function InitRequest($action = "", $request = "", DateTime $time = null) {
        if (eString::IsNullOrSpace($action)) {
            $route = Route::Current();
            $action = "{$route->controller}/{$route->action}";
        }
        if (eString::IsNullOrSpace($request)) {
            $request = http_build_query($_GET);
        }
        if (null === $time) {
            $time = new DateTime();
        }
        $this->action = $action;
        $this->request = $request;
        $this->time = $time->format('Y-m-d H:i:s');
        $this->day = $time->format('d');
        $this->hour = $time->format('H');
    }

    public $id;
    public $day;
    public $hour;
    public $action;
    public $request;
    public $response;
    public $error_code;
    public $time;

    public function Insert() {
        if (!isset($this->request)) {
            $this->InitRequest();
        }
        $tablename = MonthlyTable::ApiLogs();
        $params = array(
            ':day' => $this->day,
            ':hour' => $this->hour,
            ':action' => $this->action,
            ':request' => $this->request,
            ':response' => $this->response,
            ':error_code' => $this->error_code,
            ':time' => $this->time
        );
        $id = DbContext::QuickInsert($tablename, $params);
        $this->id = $id;
        return $id;
    }

}
