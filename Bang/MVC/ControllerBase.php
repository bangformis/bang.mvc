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
    protected function View($viewName = "") {
        if (String::IsNullOrSpace($viewName)) {
            $viewName = Route::Current()->action;
        }
        $className = String::RemoveSuffix(get_class($this), "Controller");
        $viewFile = Url::View($viewName, $className);
        ResponseBag::Add("View", $viewFile);

        $layoutFile = Path::View("_Layout", "Shared");
        require $layoutFile;
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

}
