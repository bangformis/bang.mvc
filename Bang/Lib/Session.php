<?php

/*
 * 用來存放各種 針對單一使用者工作階段 使用到的參數及物件
 */

/**
 * 使用者 工作階段資料存放
 * @author Bang
 */
class Session {

    /**
     * 自動判斷是否啟動SessionStart
     */
    public static function StartSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * 將一個物件加入store中
     * @param mixed $obj 要儲存的物件
     * @param string $name 物件名稱(索引,為空時將直接使用該物件類別名稱)
     * @return obj 若已有舊的物件將會回傳舊的
     */
    public static function Add($obj, $name = null) {
        Session::StartSession();
        $name = (!is_null($name) ? $name : get_class($obj));
        $name = strtolower($name);

        $return = null;
        if (isset($_SESSION[$name])) {
            //已經有舊的物件時,將舊的物件回傳
            $return = $_SESSION[$name];
        }

        $_SESSION[$name] = $obj;
        return $return;
    }

    /**
     * 從註冊表中取得物件
     * @param string $name 物件名稱,{@see self::set()}
     * @return mixed 物件
     */
    public static function Get($name) {
        Session::StartSession();

        $name = strtolower($name);

        if (!self::contains($name)) {
            throw new Exception("Object does not exist in eAppstore");
        }
        return $_SESSION[$name];
    }

    /**
     * 檢查是否有物件物件存在
     * @param type $name 物件名稱
     * @return boolean 檢查結果
     */
    public static function Contains($name) {
        Session::StartSession();

        $name = strtolower($name);

        if (!isset($_SESSION[$name])) {
            return false;
        }
        return true;
    }

    /**
     * 從註冊中刪除物件
     * @param string $name 物件名稱
     * @return void
     */
    public static function Remove($name) {
        Session::StartSession();

        $name = strtolower($name);
        if (self::contains($name)) {
            unset($_SESSION[$name]);
        }
    }

}