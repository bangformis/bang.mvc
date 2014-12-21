<?php

include 'Config.php';

/**
 * Exception統一處理
 * @param Exception $exception
 */
$_handleMissedException = function ($exception) {
    /*
      //可用的Exception方法
      final public string getMessage ( void )
      final public Exception getPrevious ( void )
      final public mixed getCode ( void )
      final public string getFile ( void )
      final public int getLine ( void )
      final public array getTrace ( void )
      final public string getTraceAsString ( void )
     */
    echo $exception->getTraceAsString();
};
//set_exception_handler($_handleMissedException);

/**
 * Error統一處理
 * @param int $errno 錯誤代碼
 * @param string $errstr 錯誤原因
 * @param string $errfile 錯誤檔案
 * @param string $errline 錯誤行號
 */
$_handleMissedError = function ($errno, $errstr, $errfile, $errline) {
    echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
    echo "  Fatal error on line $errline in file $errfile";
    echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
    echo "Aborting...<br />\n";
    exit(1);
};

//set_error_handler($_handleMissedError);

/**
 * 自動載入lib中的Class功能
 */
function __autoload($classname) {
    if (file_exists($classname . '.php')) {
        require_once( $classname . '.php');
    } else if (file_exists('Bang/lib/' . $classname . '.php')) {
        require_once('Bang/lib/' . $classname . '.php');
    } else {
        throw new Exception("找不到 {$classname} 這個Class檔案，無法載入！");
    }
}

//將所有mvc中的檔案載入
foreach (glob("Bang/mvc/*.php") as $filename) {
    require_once $filename;
}
