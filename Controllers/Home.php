<?php

namespace Controllers;

use Bang\Lib\Response;
use Models\ControllerBase;

/**
 * 主頁面Controller
 * @author Bang
 */
class Home extends ControllerBase\ApiControllerBase {

    public function Index() {
        Response::Forbidden();
    }

}
