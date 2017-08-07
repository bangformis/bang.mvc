<?php

require_once __DIR__ . '/Config.php';

ini_set("display_errors", Config::EnablePHPErrorReport);
error_reporting(E_ALL);

/**
 * Exception統一處理
 * @param Exception $exception
 */
$_handleMissedException = function (Exception $exception) {
    
};
/**
 * Error統一處理
 * @param int $errno 錯誤代碼
 * @param string $errstr 錯誤原因
 * @param string $errfile 錯誤檔案
 * @param string $errline 錯誤行號
 */
$_handleMissedError = function ($errno, $errstr, $errfile, $errline) {
    
};

/**
 * 自動載入lib中的Class功能
 */
function __autoload($classname) {
    $namespace_name = str_replace("\\", Config::DirSplitor, $classname);
    $namespace_path = __DIR__ . Config::DirSplitor . $namespace_name . '.php';
    if (file_exists($namespace_path)) {
        require_once($namespace_path);
    } else {
        throw new Exception("找不到 {$classname} 這個Class檔案，無法載入！");
    }
}

session_start();
