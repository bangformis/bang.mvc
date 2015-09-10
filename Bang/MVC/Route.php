<?php

/**
 * 路由類型
 * 建立使用者傳入Get值後須執行的功能
 * @author Bang
 */
class Route {

    function __construct() {
        $this->controller = "Home";
        $this->action = "Index";

        ResponseBag::Add("Route", $this);
    }

    /**
     * 控制器名稱
     * @var string 
     */
    public $controller;

    /**
     * 值行動作名稱
     * @var string
     */
    public $action;

    /**
     * 執行該Controller的Action動作
     */
    public function invoke() {
        $controllerName = "{$this->controller}Controller";
        $file_path = "Controllers/{$controllerName}.php";
        if (file_exists($file_path)) {
            require_once $file_path;
        } else {
            Response::HttpNotFound();
        }
        $reflection = new ReflectionClass($controllerName);
        $obj = $reflection->newInstanceArgs();
        if ($reflection->hasMethod($this->action)) {
            $actionMethod = $reflection->getMethod($this->action);
            $actionMethod->invoke($obj);
        } else {
            Response::HttpNotFound();
        }
        ResponseBag::Add("Route", $this);
    }

    /**
     * 取得目前的Route
     * @return Route
     */
    public static function Current() {
        return ResponseBag::Get("Route");
    }

}
