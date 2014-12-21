<?php

/**
 * 處理網址擴充功能
 * @author Bang
 */
class Url {

    /**
     * 回傳網站Root起算相對網址
     * EX:(Views/Home/Index.php) return /Views/Home/Index.php
     * @param string $url
     * @return string
     */
    public static function Content($url) {
        return Config::$Root . $url;
    }

    /**
     * 回傳網站View檔案
     * EX:(Index.php) return /Views/{ControllerName}/Index.php Or  /Views/Shared/Index.php
     * @param string $url
     * @return string View檔案網址
     */
    public static function View($name, $className = "") {
        $viewFile = Config::$Root . "Views/$className/$name.php";
        return $viewFile;
    }

    /**
     * 回傳網站Share View檔案
     * EX:(Index.php) /Views/Shared/Index.php
     * @param string $url
     * @return string View檔案網址
     */
    public static function ShareView($name) {
        $viewFile = Config::$Root . "Views/Shared/$name.php";
        return $viewFile;
    }

    /**
     * 取得Action網址
     * @param string $actionName Action名稱
     * @param string $controllerName Controller名稱
     * @param array $getParam 其他參數
     * @return string Action網址
     */
    public static function Action($actionName, $controllerName = "", $getParam = null) {
        if (empty($controllerName)) {
            $controllerName = Route::Current()->controller;
        }

        $resultUrl = Config::$Root . "Index.php?controller=$controllerName&action=$actionName";
        if (!is_null($getParam)) {
            foreach ($getParam as $key => $value) {
                $value = urlencode($value);
                $resultUrl . "&$key=$value";
            }
        }
        return $resultUrl;
    }

}
