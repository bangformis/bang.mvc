<?php

/**
 * 字串(String)擴增功能
 */
class String {

    /**
     * 判斷字串不是空值或是空白
     * @param string $str 判斷字串
     * @return bool 判斷結果
     */
    public static function IsNotNullOrSpace($str) {
        return !String::IsNullOrSpace($str);
    }

    /**
     * 判斷字串是空值或是空白
     * @param string $str 判斷字串
     * @return bool 判斷結果
     */
    public static function IsNullOrSpace($str) {
        return (!isset($str) || trim($str) === '');
    }

    /**
     * 刪除字串開頭文字
     * @param string $input 輸入值
     * @param string $prefix 開頭文字
     * @return string 刪除後字串
     */
    public static function RemovePrefix($input, $prefix) {
        $str = $input;
        if (self::StartsWith($input, $prefix)) {
            $str = substr($input, strlen($prefix));
        }
        return $str;
    }

    /**
     * 刪除字串結尾文字
     * @param string $input 輸入值
     * @param string $suffix 結尾文字
     * @return string 刪除後字串
     */
    public static function RemoveSuffix($input, $suffix) {
        $str = $input;
        if (self::EndsWith($input, $suffix)) {
            $str = substr($input, 0, strlen($input) - strlen($suffix));
        }
        return $str;
    }

    /**
     * 判斷字串是否為$test開頭
     * @param string $input 輸入值
     * @param string $test 比對值
     * @return bool 判斷結果
     */
    public static function StartsWith($input, $test) {
        return $input === "" || strpos($input, $test) === 0;
    }

    /**
     * 判斷字串是否為$test結尾
     * @param string $input 輸入值
     * @param string $test 比對值
     * @return bool 判斷結果
     */
    public static function EndsWith($input, $test) {
        return $test === "" || substr($input, -strlen($test)) === $test;
    }

}
