<?php

namespace Controllers;

use Bang\Lib\Response;
use Bang\Lib\TaskResult;
use Models\ControllerBase;

/**
 * 主頁面Controller
 * @author Bang
 */
class Home extends ControllerBase\ApiControllerBase {

    public function Index() {
        Response::Forbidden();
    }
    
    public function Success(){
        $result = new TaskResult();
        $result->SetSuccess();
        return $this->Json($result);
    }

}
