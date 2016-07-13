<?php

namespace Models\RequestBag;

use Bang\Lib\Checker;
use Bang\Lib\String;
use Exception;
use Models\ErrorCode;

/**
 * @author Bang
 */
class Base {

    protected function ThrowException($message, $code) {
        throw new Exception($message, $code);
    }

    /**
     * @param array $array ex: array('Username','Password', ...)
     */
    public function ValidProperties($array) {
        foreach ($array as $value) {
            if (String::IsNullOrSpace($this->{$value})) {
                $this->ThrowException("缺少必要参数：{$value}", ErrorCode::MissingParameter);
            }
        }
    }

    public function ValidPositive($number) {
        $value = doubleval($number);
        if ($value < 0) {
            $this->ThrowException('带入的数值不可为负数！', ErrorCode::WrongFormat);
        }
    }

    public function HasProperties($array) {
        foreach ($array as $value) {
            if (String::IsNotNullOrSpace($this->{$value})) {
                return true;
            }
        }
        return false;
    }

    public function ValidIsBoolean($param) {
        $test = intval($this->{$param});
        if ($test !== 0 && $test !== 1) {
            $this->ThrowException("{$param}参数必须为1或0!", ErrorCode::WrongFormat);
        }
    }

    public function ValidIsDate($param) {
        $test = $this->{$param};
        if (String::IsNotNullOrSpace($test) && !Checker::IsDate($test)) {
            $this->ThrowException("{$param}参数日期格式有误!", ErrorCode::WrongFormat);
        }
    }

}
