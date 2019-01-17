<?php

namespace Controllers;

use Bang\Lib\Response;
use Bang\Lib\TaskResult;
use Models\ControllerBase\ApiControllerBase;
use Models\RequestBag\Test;

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
        $bag = Test::GetFromQuery();
        $bag->Valid();
        $result->SetSuccess(true, 'test success!');
        return $this->Json($result);
    }

    public function TestUnSuccess() {
        $result = new TaskResult();
        $bag = Test::GetFromQuery();
        $bag->Valid();
        $result->SetUnsuccess('test unsuccess!');
        return $this->Json($result);
    }

}
