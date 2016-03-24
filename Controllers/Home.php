<?php
namespace Controllers;

use Models\RequestBag;
use Models\ControllerBase;

/**
 * 主頁面Controller
 * @author Bang
 */
class Home extends ControllerBase\ApiControllerBase {

    public function Index() {
        \Bang\Lib\Response::Forbidden();
    }

    public function TestSuccess() {
        $result = new \Bang\Lib\TaskResult();
        $bag = RequestBag\Test::GetFromQuery();
        $bag->Valid();
        $result->SetSuccess(true, 'test success!');
        return $this->Json($result);
    }

    public function TestUnSuccess() {
        $result = new \Bang\Lib\TaskResult();
        $bag = RequestBag\Test::GetFromQuery();
        $bag->Valid();
        $result->SetUnsuccess('test unsuccess!');
        return $this->Json($result);
    }

}
