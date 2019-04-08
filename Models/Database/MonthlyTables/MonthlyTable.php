<?php

namespace Models\Database\MonthlyTables;

use Bang\Lib\eString;
use Bang\MVC\DbContext;
use Models\Current;
use PDO;

class MonthlyTable {

    private static $yyyyMM = null;

    public static function GetYm() {
        if (self::$yyyyMM == null) {
            $datetime = Current\Request::GetLibDatetime();
            self::$yyyyMM = $datetime->ToYYYYmm();
        }
        return self::$yyyyMM;
    }

    public static function IdGenerator($yyyyMM = '') {
        if (eString::IsNullOrSpace($yyyyMM)) {
            $yyyyMM = self::GetYm();
        }
        $table_name = "id_generator";
        $sql_without_create = "(
                                    `id`  bigint(20) NOT NULL AUTO_INCREMENT ,
                                    `content`  varchar(1) CHARACTER SET ascii COLLATE ascii_general_ci NULL DEFAULT NULL ,
                                    PRIMARY KEY (`id`)
                                )
                                ENGINE=InnoDB
                                DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
                                ROW_FORMAT=COMPACT
                                ;";
        return self::GetSplitTableName($table_name, $sql_without_create, $yyyyMM);
    }

    public static function ApiLogs($yyyyMM = '') {

        if (eString::IsNullOrSpace($yyyyMM)) {
            $yyyyMM = self::GetYm();
        }
        $table_name = "api_logs";
        $sql_without_create = "(
                                    `id`  int(20) NOT NULL AUTO_INCREMENT ,
                                    `day`  int(11) NOT NULL ,
                                    `hour`  int(11) NOT NULL ,
                                    `action`  varchar(50) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL ,
                                    `request`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
                                    `response`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
                                    `error_code`  varchar(35) CHARACTER SET ascii COLLATE ascii_general_ci NULL DEFAULT NULL ,
                                    `time`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
                                    `span_ms`  varchar(35) CHARACTER SET ascii COLLATE ascii_general_ci NULL DEFAULT NULL ,
                                    PRIMARY KEY (`id`),
                                    INDEX `day_index` USING BTREE (`day`) ,
                                    INDEX `hour_index` USING BTREE (`hour`) ,
                                    INDEX `action_index` USING BTREE (`action`) ,
                                    INDEX `error_code_index` USING BTREE (`error_code`) 
                                )
                                ENGINE=InnoDB
                                DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
                                AUTO_INCREMENT=1
                                ROW_FORMAT=COMPACT
                                ;";
        return self::GetSplitTableName($table_name, $sql_without_create, $yyyyMM);
    }

    /**
     * @param string $table_name 未分割資料表名稱
     * @param string $create_table_sql_without_create 不包含(CREATE TABLE `TableName`)敘述的完整SQL
     * @return string 實際資料表名稱
     */
    private static function GetSplitTableName($table_name, $create_table_sql_without_create, $yyyyMM = '') {

        if (eString::IsNullOrSpace($yyyyMM)) {
            $yyyyMM = self::GetYm();
        }

        $split_table_name = "{$table_name}_{$yyyyMM}";
        $sql = "show tables like '{$split_table_name}'";
        $query_result = DbContext::Query($sql);
        $query_result->fetchAll(PDO::FETCH_ASSOC);
        $row_count = $query_result->rowCount();

        if ($row_count == 0) { //沒有該月表
            $create_sql = "CREATE TABLE `{$split_table_name}` " . $create_table_sql_without_create;
            DbContext::Query($create_sql);
        }

        return $split_table_name;
    }

}
