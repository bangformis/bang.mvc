<?php

namespace Models\Current;

use Bang\Lib\eDateTime;
use DateTime;

/**
 * @author Bang
 */
class Request {

    private static $Time = null;
    private static $eDateTime = null;

    /**
     * @return DateTime
     */
    public static function GetDatetime() {
        if (is_null(self::$Time)) {
            self::$Time = new DateTime();
        }
        return self::$Time;
    }

    /**
     * @return eDateTime
     */
    public static function GetLibDatetime() {
        if (is_null(self::$eDateTime)) {
            $datetime = self::GetDatetime();
            self::$eDateTime = eDateTime::CreateByTimestamp($datetime->getTimestamp());
        }
        return self::$eDateTime;
    }

    public static function GetYmdhisTime() {
        $datetime = Request::GetDatetime();
        return $datetime->format('Y-m-d H:i:s');
    }

    private static $request_id;

    public static function GetId() {
        if (!isset(self::$request_id)) {
            $datetime = self::GetLibDatetime();
            self::$request_id = uniqid($datetime->ToTimestamp() . ".", true);
        }
        return self::$request_id;
    }

}
