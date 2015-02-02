<?php

/**
 * 資料庫類型容器基底
 * @author Bang
 */
class DbContext {

    /**
     * 實作單例連線
     * @var PDO 連線
     */
    private static $Connection = NULL;

    /**
     * 取得PDO連線
     * @return PDO 連線物件
     */
    public static function GetConnection() {
        if (is_null(DbContext::$Connection)) {
            $host = Config::DbHost;
            $name = Config::DbName;
            DbContext::$Connection = new PDO("mysql:host=$host;dbname=$name;charset=utf8", Config::DbUser, Config::DbPassword);
        }
        return DbContext::$Connection;
    }

    /**
     * 執行Query
     * @param string $sql Prepare SQL語法
     * @param array $params 傳入參數
     * @return PDOStatement 查詢結果
     */
    public static function Query($sql, $params) {
        $con = DbContext::GetConnection();
        $stem = $con->prepare($sql);
        $stem->execute($params);
        return $stem;
    }
    
    

}
