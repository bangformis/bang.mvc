<?php

/**
 * 所有Controller的基底
 * @author Bang
 */
class ControllerBase {

    /**
     * 回傳View結果
     * 帶預設Layout.php
     */
    protected function View($viewName = "", $layout = "_Layout") {
        if (String::IsNullOrSpace($viewName)) {
            $viewName = Route::Current()->action;
        }
        $className = String::RemoveSuffix(get_class($this), "Controller");
        $viewFile = "$className/$viewName.php";
        ResponseBag::Add("View", $viewFile);
        $layoutFile = Path::View($layout, "Shared");
        include $layoutFile;
    }

    /**
     * 回傳Json格式結果
     * @param object $obj 傳入物件，為空時將自動傳TaskResult並IsSuccess為true
     */
    protected function Json($obj = NULL) {
        header('Content-Type: application/json');
        if ($obj === NULL) {
            $obj = new TaskResult();
            $obj->IsSuccess = true;
        }
        echo json_encode($obj);
    }

    /**
     * 以 Json 字串回傳json格式
     * @param string $json_str 傳入JSON格式字串，為空時將自動傳TaskResult並IsSuccess為true
     */
    protected function JsonContent($json_str) {
        header('Content-Type: application/json');
        echo $json_str;
    }

    /**
     * 重新導向網址
     * @param string $url 導向的網址
     */
    protected function RedirectToUrl($url) {
        Response::RedirectUrl($url);
        die();
    }

    /**
     * 重新導向網址
     * @param string $url 導向的網址
     */
    protected function RedirectToAction($actoiName, $controller = null, $params = array()) {
        if (null == $controller) {
            $controller = Route::Current()->controller;
        }
        $url = Url::Action($actoiName, $controller, $params);
        $this->RedirectToUrl($url);
    }

}
