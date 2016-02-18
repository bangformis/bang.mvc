<?php

use Models\RequestBag;
use Models\ControllerBase;

/**
 * 主頁面Controller
 * @author Bang
 */
class HomeController extends ControllerBase\ApiControllerBase {

    public function Index() {
        Response::HttpNotFound();
    }

    public function TestSuccess() {
        $result = new TaskResult();
        $bag = RequestBag\Test::GetFromQuery();
        $bag->Valid();
        $result->SetSuccess(true, 'test success!');
        return $this->Json($result);
    }

    public function TestUnSuccess() {
        $result = new TaskResult();
        $bag = RequestBag\Test::GetFromQuery();
        $bag->Valid();
        $result->SetUnsuccess('test unsuccess!');
        return $this->Json($result);
    }

}
