<?php

require_once __DIR__ . '/Config.php';

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

    $content = $exception->getTraceAsString();
    $filename = $exception->getFile();
    $line = $exception->getLine();
    $msg = $exception->getMessage();
    $log = error_log::CreateInstance($content, $filename, $line, $msg);
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

    $content = $errstr;
    $filename = $errfile;
    $line = $errline;
    $msg = 'errorno:' . $errno;
    $log = error_log::CreateInstance($content, $filename, $line, $msg);
    $log->Insert();
};

if (Config::IsReleaseMode) {
    set_exception_handler($_handleMissedException);
    set_error_handler($_handleMissedError);
}

class BangSystem {

    /**
     * @var array 自動加載的所有套件字串
     */
    private static $__AutoIncludes = array();

    /**
     * 加入AutoLoad資料夾，可將資料夾位置傳入Autoload將自動掃描該資料夾
     * @param mixed $paths array or string
     */
    public static function AddAutoIncludes($paths) {
        if (is_array($paths)) {
            foreach ($paths as $path) {
                BangSystem::$__AutoIncludes[] = __DIR__ . '/' . $path;
            }
        } else {
            BangSystem::$__AutoIncludes[] = __DIR__ . '/' . $paths;
        }
    }

    public static function GetAutoIncludes() {
        return BangSystem::$__AutoIncludes;
    }

}

/**
 * 自動載入lib中的Class功能
 */
function __autoload($classname) {
    if (file_exists(__DIR__ . '/Bang/MVC/' . $classname . '.php')) {
        require_once(__DIR__ . '/Bang/MVC/' . $classname . '.php');
    } else if (file_exists(__DIR__ . '/Bang/Lib/' . $classname . '.php')) {
        require_once(__DIR__ . '/Bang/Lib/' . $classname . '.php');
    } else {
        $exists = false;
        $all_paths = BangSystem::GetAutoIncludes();
        foreach ($all_paths as $key => $path) {
            if (file_exists($path . $classname . '.php')) {
                $exists = true;
                require_once( $path . $classname . '.php');
            }
        }
        if (!$exists) {
            throw new Exception("找不到 {$classname} 這個Class檔案，無法載入！");
        }
    }
}

require_once 'Autoloads.php';
