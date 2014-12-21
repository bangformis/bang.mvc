<?php

/*
 * 主要在於協助取得使用者Request來的資料
 * 以物件方式取得
 */

/**
 * Request擴充功能
 * @author Bang
 */
class Request {

    /**
     * 取得使用者的請求資料
     * @param mixed $obj 傳入取值物件
     * @param boolean $isPost 是否為Post方式傳遞
     */
    public static function GetParam($obj, $isPost = false) {
        $from = ($isPost ? $_POST : $_GET);

        $reflect = new ReflectionClass($obj);
        $properties = $reflect->getProperties();
        foreach ($properties as $property) {
            $name = $property->name;
            if (isset($from[$name])) {
                $property->setValue($obj, $from[$name]);
            }
        }
        return $obj;
    }

    /**
     * 取得Post資料 EX:getPost($result = new NewClasss())將取得回傳的NewClass
     * @param type $obj 傳入對應Class的物件
     */
    public static function GetPost($obj) {
        return Request::GetParam($obj, true);
    }

    /**
     * 取得Get資料 EX:getGet($result = new NewClasss())將取得回傳的NewClass
     * @param type $obj 傳入對應Class的物件
     */
    public static function GetGet($obj) {
        return Request::GetParam($obj, false);
    }

}
