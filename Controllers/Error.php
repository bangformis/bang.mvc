<?php

namespace Controllers;

use Bang\Lib\TaskResult;
use Exception;
use Models\ControllerBase;
use Models\ErrorCode;
use Models\RequestBag\Test;

/**
 * 主頁面Controller
 * @author Bang
 */
class Error extends ControllerBase\ApiControllerBase {

    function __construct() {
        throw new Exception("在ApiBase前的Exception", ErrorCode::UnKnownError);
        parent::__construct();
    }

    public function TestSuccess() {
        $result = new TaskResult();
        $bag = Test::GetFromQuery();
        $bag->Valid();
        $result->SetSuccess(true, 'test success!');
        return $this->Json($result);
    }

}
