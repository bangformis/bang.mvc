<?php

namespace Models\Current;

/**
 * @author Bang
 */
class Request {

    private static $Time = null;

    /**
     * @return DateTime
     */
    public static function GetDatetime() {
        if (is_null(Request::$Time)) {
            Request::$Time = new \DateTime();
        }
        return Request::$Time;
    }

    public static function GetYmdhisTime() {
        $datetime = Request::GetDatetime();
        return $datetime->format('Y-m-d H:i:s');
    }

}
