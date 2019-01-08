<?php

namespace Models\Database\MonthlyTables;

use Bang\MVC\DbContext;
use Models\Current\Request;

/**
 * @author Bang
 */
class id_generator {

    /**
     * 取得單純數字SN
     * @return int
     */
    public static function NewSn() {
        $table = MonthlyTable::IdGenerator();
        $sql = "INSERT INTO `{$table}` (`content`) VALUES ('y')";
        $id = DbContext::Insert($sql);
        return $id;
    }

    /**
     * 取得包含年月的SN
     * @return string ex:{yyyymm}
     */
    public static function GetNewIdWithYm() {
        $sn = self::NewSn();
        $datetime = Request::GetLibDatetime();
        $yyyymm = $datetime->ToYYYYmm();
        $id_str = str_pad($sn, 15, '0', STR_PAD_LEFT);
        $result = "{$yyyymm}{$id_str}";
        return $result;
    }

    public static function GetYmById($id_with_Ym) {
        $result = substr($id_with_Ym, 0, 6);
        return $result;
    }

}
