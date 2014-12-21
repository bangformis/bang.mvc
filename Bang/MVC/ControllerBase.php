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
    protected function View($viewName) {
        $className = String::RemoveSuffix(get_class($this), "Controller");
        $viewFile = Url::View($viewName, $className);
        ResponseBag::Add("View", $viewFile);

        $layoutFile = Config::$Root . "Views/Shared/_Layout.php";
        include $layoutFile;
    }

    /**
     * 回傳Json格式結果
     */
    protected function Json($obj) {
        header('Content-Type: application/json');
        echo json_encode($obj);
    }

}
