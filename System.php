<?php

include 'Config.php';

ini_set("display_errors", "1");
error_reporting(E_ALL);

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
    $log = new error_log();
    $log->content = $exception->getTraceAsString();
    $log->file = $exception->getFile();
    $log->line = $exception->getLine();
    $log->message = $exception->getMessage();
    $log->Insert();
    die();
};
/**
 * Error統一處理
 * @param int $errno 錯誤代碼
 * @param string $errstr 錯誤原因
 * @param string $errfile 錯誤檔案
 * @param string $errline 錯誤行號
 */
$_handleMissedError = function ($errno, $errstr, $errfile, $errline) {
    $log = new error_log();
    $log->content = $errstr;
    $log->file = $errfile;
    $log->line = $errline;
    $log->Insert();
};

if (Config::IsReleaseMode) {
    set_exception_handler($_handleMissedException);
    set_error_handler($_handleMissedError);
}

Config::AddAutoIncludes(Path::Content('Bang/MVC/'));

/**
 * 自動載入lib中的Class功能
 */
function __autoload($classname) {
    if (file_exists('Bang/MVC/' . $classname . '.php')) {
        require_once('Bang/MVC/' . $classname . '.php');
    } else if (file_exists('Bang/Lib/' . $classname . '.php')) {
        require_once('Bang/Lib/' . $classname . '.php');
    } else {
        $exists = false;
        $all_paths = Config::GetAutoIncludes();
        foreach($all_paths as $key => $path){
            if (file_exists($path . $classname . '.php')) {
                $exists = true;
                require_once( $path . $classname . '.php');
            }
        }
        if(!$exists){
            throw new Exception("找不到 {$classname} 這個Class檔案，無法載入！");
        }
    }
}
