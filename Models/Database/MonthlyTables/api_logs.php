<?php

namespace Models\Database\MonthlyTables;

use Bang\Lib\eDateTime;
use Bang\Lib\eString;
use Bang\Lib\MySqlDb;
use Bang\MVC\DbContext;
use Bang\MVC\Route;

/**
 * @author Bang
 */
class api_logs {

    function __construct() {
        $this->error_code = 0;
    }

    public $id;
    public $day;
    public $hour;
    public $action;
    public $request;
    public $response;
    public $error_code;
    public $time;
    public $span_ms;

    public function InitRequest($action = "", $request = "", eDateTime $time = null) {
        if (eString::IsNullOrSpace($action)) {
            $route = Route::Current();

            $action = "{$route->controller}/{$route->action}";
        }
        if (eString::IsNullOrSpace($request)) {
            $request = http_build_query($_GET);
        }
        if (null === $time) {
            $time = new eDateTime();
        }
        $this->action = $action;
        $this->request = $request;
        $this->time = $time->Format('Y-m-d H:i:s');
        $this->day = $time->Format('d');
        $this->hour = $time->Format('H');
    }

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

    public function Update() {
        $table = MonthlyTable::ApiLogs();
        $params = MySqlDb::GetParamsByObject($this);
        unset($params[':id']);
        $params[':where_id'] = $this->id;
        $stem = DbContext::QuickUpdate($table, " `id`=:where_id ", $params);
        $result = $stem->rowCount() === 1;
        return $result;
    }

}
