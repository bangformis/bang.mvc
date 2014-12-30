<?php

require_once '../Config.php';

$root = "../";

/**
 * 自動載入lib中的Class功能
 */
function __autoload($classname) {
    $root = "../";
    if (file_exists($root . $classname . '.php')) {
        require_once($root . $classname . '.php');
    } else if (file_exists($root . 'Bang/Lib/' . $classname . '.php')) {
        require_once($root . 'Bang/Lib/' . $classname . '.php');
    } else {
        throw new Exception("找不到 {$classname} 這個Class檔案，無法載入！");
    }
}

//將所有mvc中的檔案載入
foreach (glob($root . "Bang/MVC/*.php") as $filename) {
    require_once $filename;
}
