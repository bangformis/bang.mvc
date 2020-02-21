<?php

namespace Controllers;

use Bang\Lib\Response;
use Bang\Lib\TaskResult;
use Models\ControllerBase\ApiControllerBase;

/**
 * 主頁面Controller
 * @author Bang
 */
class Home extends ApiControllerBase {

    public function Index() {
        Response::Forbidden();
    }

    public function TestSuccess() {
        $result = new TaskResult();
        $result->SetSuccess();
        return $this->Json($result);
    }

    public function TestUnSuccess() {
        $result = new TaskResult();
        $result->SetUnsuccess('Test');
        return $this->Json($result);
    }

}
