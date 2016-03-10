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
                $this->ThrowException("缺少必要参数：{$value}", \ErrorCode::MissingParameter);
            }
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

}
