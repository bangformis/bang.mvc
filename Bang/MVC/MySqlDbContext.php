<?php

/**
 * 資料庫類型容器基底
 * @author Bang
 */
class MySqlDbContext {

    /**
     * 實作單例連線
     * @var PDO 連線
     */
    private static $Connection;

    /**
     * 取得PDO連線
     * @return PDO 連線物件
     */
    public static function GetConnection() {
        if (!isset(DbContext::$Connection)) {
            $host = Config::DbHost;
            $name = Config::DbName;
            DbContext::$Connection = new PDO("mysql:host=$host;dbname=$name;charset=utf8", Config::DbUser, Config::DbPassword);
        }
        return DbContext::$Connection;
    }

}
