<?php

/**
 * @author Bang
 */
class Math {

    /**
     * @param int $n C n取r的n
     * @param int $r C n取r的r
     * @return int 结果计算值
     */
    public static function C($n, $r) {
        if ((!is_numeric($n)) || (!is_numeric($r))) {
            throw new Exception('输入格式不正确！');
        }
        if ($r > $n) {
            throw new Exception('C n取r r不可大于n！');
        }
        if (($n - $r) < $r) {
            return Math::C($n, ($n - $r));
        } else {
            $return = 1;
            for ($i = 0; $i < $r; $i++) {
                $return *= ($n - $i) / ($i + 1);
            }
            return $return;
        }
    }

    /**
     * @param int $n P n取r的n
     * @param int $r P n取r的r
     * @return int 结果计算值
     */
    public static function P($n, $r) {
        if ((!is_numeric($n)) || (!is_numeric($r))) {
            throw new Exception('输入格式不正确！');
        }
        if ($r > $n) {
            throw new Exception('P n取r r不可大于n！');
        }
        if ($r) {
            return $n * (Math::P($n - 1, $r - 1));
        } else {
            return 1;
        }
    }

}
