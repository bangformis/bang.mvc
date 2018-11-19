<?php

require_once __DIR__ . '/Config.php';

ini_set("display_errors", Config::EnablePHPErrorReport);
error_reporting(E_ALL);

/**
 * 自動載入lib中的Class功能
 */
function __bang_mvc_autoload($classname) {
    $namespace_name = str_replace("\\", Config::DirSplitor, $classname);
    $namespace_path = __DIR__ . Config::DirSplitor . $namespace_name . '.php';
    if (file_exists($namespace_path)) {
        require_once($namespace_path);
    } else {
        throw new Exception("找不到 {$classname} 這個Class檔案，無法載入！");
    }
}

spl_autoload_register('__bang_mvc_autoload');

session_start();
