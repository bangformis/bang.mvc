<?php

namespace Bang\Lib;

use DateInterval;
use DateTime;

/**
 * @author Bang
 */
class eDateTime {

    function __construct($time = null) {
        if (String::IsNotNullOrSpace($time)) {
            $this->datetime = new DateTime($time);
        } else {
            $this->datetime = new DateTime();
        }
    }

    /**
     * @var DateTime
     */
    private $datetime;

    /**
     * 與原本Datetime相同
     * @param string $format
     * @return string
     */
    public function Format($format) {
        return $this->datetime->format($format);
    }

    /**
     * @param int $count
     */
    public function AddSeconds($count) {
        $min_count = intval($count);
        if ($min_count < 0) {
            $this->datetime->modify("{$min_count} second");
        } else {
            $this->datetime->modify("+{$min_count} second");
        }
    }

    public function AddMinutes($count) {
        $min_count = intval($count);
        if ($min_count < 0) {
            $min_count = $min_count * -1;
            $this->datetime->sub(new DateInterval("PT{$min_count}M"));
        } else {
            $this->datetime->add(new DateInterval("PT{$min_count}M"));
        }
    }

    public function AddMonth($count) {
        $day_count = intval($count);
        if ($day_count < 0) {
            return $this->SubMonth($day_count * -1);
        } else {
            $this->datetime->add(new DateInterval("P{$day_count}M"));
        }
    }

    private function SubMonth($count) {
        $day_count = intval($count);
        if ($day_count < 0) {
            return $this->AddMonth($day_count * -1);
        } else {
            $this->datetime->sub(new DateInterval("P{$day_count}M"));
        }
    }

    public function AddDay($count) {
        $day_count = intval($count);
        if ($day_count < 0) {
            return $this->SubDay($day_count * -1);
        } else {
            $this->datetime->add(new DateInterval("P{$day_count}D"));
        }
    }

    private function SubDay($count) {
        $day_count = intval($count);
        if ($day_count < 0) {
            return $this->AddDay($day_count * -1);
        } else {
            $this->datetime->sub(new DateInterval("P{$day_count}D"));
        }
    }

    public function ToDateTimeString() {
        return $this->datetime->format('Y-m-d H:i:s');
    }

    public function ToDateString() {
        return $this->datetime->format('Y-m-d');
    }

    public function ToYYmm() {
        return $this->datetime->format('ym');
    }

    public function GetDay() {
        return $this->datetime->format('d');
    }

    public function GetYear() {
        return $this->datetime->format('Y');
    }

    public function GetMonth() {
        return $this->datetime->format('m');
    }

    /**
     * @return eDateTime
     */
    public static function GetFirstDateOfThisMonth() {
        $datetime = new eDateTime('first day of this month');
        return $datetime;
    }

}
