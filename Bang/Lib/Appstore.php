<?php

/*
 * 用來存放各種應用程式會使用到的參數及物件
 */

/**
 * 應用程式單例存放(Registry實作)
 * @author Bang
 */
class Appstore {

    /**
     * @var array 存放物件的陣列
     */
    protected static $_store = array();

    /**
     * 將一個物件加入store中
     * @param mixed $obj 要儲存的物件
     * @param string $name 物件名稱(索引,為空時將直接使用該物件類別名稱)
     * @return obj 若已有舊的物件將會回傳舊的
     */
    public static function add($obj, $name = null) {

        $name = (!is_null($name) ? $name : get_class($obj));
        $name = strtolower($name);

        $return = null;
        if (isset(self::$_store[$name])) {
            //已經有舊的物件時,將舊的物件回傳
            $return = self::$_store[$name];
        }

        self::$_store[$name] = $obj;
        return $return;
    }

    /**
     * 從註冊表中取得物件
     * @param string $name 物件名稱,{@see self::set()}
     * @return mixed 物件
     */
    public static function get($name) {
        $name = strtolower($name);
        
        if (!self::contains($name)) {
            throw new Exception("Object does not exist in eAppstore");
        }
        return self::$_store[$name];
    }

    /**
     * 檢查是否有物件物件存在
     * @param type $name 物件名稱
     * @return boolean 檢查結果
     */
    public static function contains($name) {
        $name = strtolower($name);
        
        if (!isset(self::$_store[$name])) {
            return false;
        }
        return true;
    }

    /**
     * 從註冊中刪除物件
     * @param string $name 物件名稱
     * @return void
     */
    public static function remove($name) {
        $name = strtolower($name);
        if (self::contains($name)) {
            unset(self::$_store[$name]);
        }
    }

}
