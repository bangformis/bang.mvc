<?php

namespace Controllers;

use Bang\Lib\Response;
use Bang\MVC\ControllerBase;

/**
 * 主頁面Controller
 * @author Bang
 */
class Home extends ControllerBase {

    public function Index() {
        Response::Forbidden();
    }

}
