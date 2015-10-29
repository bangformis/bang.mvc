<?php

/**
 * 资料检查功能
 * @author Bang
 */
class Checker {

    public static function IsEmail($input) {
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     * 检查是否为TUID
     * @param string $tuid
     * @return boolean
     */
    public static function IsTuid($tuid) {
        $bit_reg = "[0-9a-f]";
        $pattern = "/^({$bit_reg}{8}\-{$bit_reg}{4}\-{$bit_reg}{4}\-{$bit_reg}{4}\-{$bit_reg}{12})$/";
        $result = preg_match($pattern, $tuid);
        return $result == 1;
    }

}
