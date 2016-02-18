<?php

namespace Models\Current;

/**
 * @author Bang
 */
class Current {

    /**
     * @var \Models\Database\api_logs 
     */
    private static $_Logs = null;

    /**
     * @return \Models\Database\api_logs
     */
    public static function GetLogger() {
        if (null == Current::$_Logs) {
            Current::$_Logs = new \Models\Database\api_logs();
        }
        return Current::$_Logs;
    }

}
