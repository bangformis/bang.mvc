<?php

namespace Models\Database;

/**
 * @author Bang
 */
class api_logs {

    public function InitRequest($action, $request, \DateTime $time) {
        $this->action = $action;
        $this->request = $request;
        $this->time = $time->format('Y-m-d H:i:s');
        $this->day = $time->format('d');
        $this->hour = $time->format('H');
        $this->error_code = 0;
    }

    public $id;
    public $day;
    public $hour;
    public $action;
    public $request;
    public $response;
    public $error_code;
    public $mobile_number;
    public $time;

    public function Insert() {
        $tablename = MonthlyTable::ApiLogs();
        $params = array(
            ':day' => $this->day,
            ':hour' => $this->hour,
            ':action' => $this->action,
            ':request' => $this->request,
            ':response' => $this->response,
            ':error_code' => $this->error_code,
            ':mobile_number' => $this->mobile_number,
            ':time' => $this->time
        );
        $id = \DbContext::QuickInsert($tablename, $params);
        return $id;
    }

}
