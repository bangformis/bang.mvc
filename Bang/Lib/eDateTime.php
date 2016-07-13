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

}
