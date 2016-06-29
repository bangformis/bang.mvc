<?php

namespace Models\RequestBag;

/**
 * @author Bang
 */
class Base {

    protected function ThrowException($message, $code) {
        throw new \Exception($message, $code);
    }

    /**
     * @param array $array ex: array('Username','Password', ...)
     */
    public function ValidProperties($array) {
        foreach ($array as $value) {
            if (\Bang\Lib\String::IsNullOrSpace($this->{$value})) {
                $this->ThrowException("缺少必要参数：{$value}", \Models\ErrorCode::MissingParameter);
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
            if (\Bang\Lib\String::IsNotNullOrSpace($this->{$value})) {
                return true;
            }
        }
        return false;
    }

    public function ValidIsBoolean($param) {
        $test = intval($this->{$param});
        if ($test !== 0 && $test !== 1) {
            $this->ThrowException("{$param}参数必须为1或0!", \Models\ErrorCode::WrongFormat);
        }
    }

}
