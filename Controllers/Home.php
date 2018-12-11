<?php

namespace Controllers;

use Bang\Lib\Response;
use Models\ControllerBase\ApiControllerBase;

/**
 * 主頁面Controller
 * @author Bang
 */
class Home extends ApiControllerBase {

    public function Index() {
        Response::Forbidden();
    }

}
